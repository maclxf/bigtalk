import config from "@config";

const host = config.wsHOST;

export default class WebSocket {
  constructor({ heartBeat, roomId, onMessage }) {
    // 是否已连接

    this.connected = false;

    // 当前网络状态

    this.netWorkState = true;

    // 心跳检测频率

    this.timeout = 15000;

    // 计时器ID

    this.timer = null;

    // 当前重连次数

    this.connectNum = 0;

    // 心跳检测和断线重连开关

    this.heartBeat = heartBeat;

    // 房间id

    this.roomId = roomId;

    // 回调监听

    this.message = onMessage;

    // socketTask

    this.socketTask = null;

    // 初始化

    this.initWebSocket();
  }

  /**

     * 建立websocket连接

     * @param {*} options

     */

  initWebSocket(options) {
    const that = this;

    if (this.connected) {
      console.log("socket已连接");
    } else {
      // 检查网络

      wx.getNetworkType({
        success(net) {
          if (net.networkType != "none") {
            const appId = that.appId();

            that.socketTask = wx.connectSocket({
              url: `${host}${that.roomId}/${appId}`,

              success(res) {
                console.log("socket连接成功", res);

                // 已连接

                that.connected = true;
              },

              fail(err) {
                console.log("socket连接失败", err);
              },
            });

            // 监听 WebSocket 连接打开事件

            that.onSocketOpened();

            // 监听 WebSocket 连接关闭事件

            that.onSocketClosed();

            // 监听websocket 错误

            that.onSocketError();

            // 存在发生数据则需要发送数据

            if (options) {
              that.sendWebSocketMsg(options);
            }
          } else {
            that.netWorkState = false;
          }
        },
      });
    }
  }

  /**


     * WebSocket 错误事件的回调函数


     */

  onSocketError() {
    const that = this;

    that.socketTask.onError((errMsg) => {
      console.log(errMsg);
    });
  }

  /**


     * 监听 WebSocket 连接打开事件


     */

  onSocketOpened() {
    const that = this;

    that.socketTask.onOpen((res) => {
      console.log("socketTask.onOpen", res);

      // 检查心跳

      if (that.heartBeat) {
        that.resetHeartBeat();

        that.startHeartBeat();
      }

      that.sendTestMessage();

      that.onReceivedMsg();

      // 网络状态

      that.netWorkState = true;
    });
  }

  /**


     * 心跳检查重置


     */

  resetHeartBeat() {
    this.timer && clearTimeout(this.timer);
  }

  /**


     * 心跳检查开始


     */

  startHeartBeat() {
    const that = this;

    that.timer = setInterval(() => {
      that.sendTestMessage();
    }, that.timeout);
  }

  /**


     * 发送hearBeat测试信息


     */

  sendTestMessage() {
    const that = this;

    that.socketTask.send({
      // 心跳发送的信息应由前后端商量后决定

      data: "HeartBeat",

      success(res) {
        console.log("发送测试信息成功", res);
      },

      fail(err) {
        console.log("发送测试信息失败", err);

        that.resetHeartBeat();
      },
    });
  }
  /**


     * 监听websocket连接关闭


     */

  onSocketClosed() {
    const that = this;

    that.socketTask.onClose((code, reason) => {
      console.log(`连接已关闭,信息:${code}-${reason}`);

      // 停止心跳连接

      if (this.heartBeat) {
        this.resetHeartBeat();
      }

      // 更新已连接状态

      this.connected = false;
    });
  }

  /**


     * 重连方法，会根据时间频率越来越慢


     * @param {*} options


     */

  reConnect(options) {
    if (this.connectNum > 20) {
      setTimeout(() => {
        this.initWebSocket(options);
      }, 3000);

      this.connectNum += 1;
    } else if (this.connectNum > 50) {
      setTimeout(() => {
        this.initWebSocket(options);
      }, 10000);

      this.connectNum += 1;
    } else {
      setTimeout(() => {
        this.initWebSocket(options);
      }, 450000);

      this.connectNum += 1;
    }
  }

  /**


     * 获取随机数


     * @returns


     */

  appId() {
    return Math.floor(Math.random() * 4294967294 + 1);
  }

  /**


     * 接收服务器返回的消息


     */

  onReceivedMsg() {
    const that = this;

    console.log("socketTask.onMessage");

    that.socketTask.onMessage((data) => {
      this.message && this.message(data);
    });
  }

  /**


     * 发送websocket消息


     * @param {*} options


     */

  sendWebSocketMsg(options) {
    const that = this;

    const data = {
      ...options.data,
      roomId: that.roomId,
      topic: `topic_${that.roomId}`,
    };

    that.socketTask.send({
      data: JSON.stringify(data),

      success() {
        console.log("发送消息成功", data);
      },

      fail(err) {
        console.log("发送消息失败", err);

        that.reConnect(options);
      },
    });
  }

  /**


     * 关闭websocket连接


     */

  closeWebSocket() {
    const that = this;

    that.socketTask.close({
      success(res) {
        console.log("关闭socket成功", res);

        that.heartBeat = false;
      },

      fail(err) {
        console.log("关闭socket失败", err);
      },
    });
  }
}

import WebSocket from "@utils/WebSocket";

const roomId = "XXXXX";

const socket = new WebSocket({
  heartBeat: true,

  roomId,

  onMessage: this._onMessage,
});

_onMessage = (data) => {
  const that = this;

  if (data && data.data != "health") {
    data = JSON.parse(data?.data);
  }

  console.log("socket回调结果处理", data);
};
