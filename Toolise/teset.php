<?php use EasyWeChat\Message\Text;

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//创建pdf扩展类
class NewPdfCreate {
    //全局变量
    protected $CI;
    //tcpdf对象
    protected $tcpdf;
    protected $_this_time;
    const C_DIR = 'create_pdf'.DIRECTORY_SEPARATOR;
    public function __construct() {
        $this->CI =& get_instance();

        // 重名会引起覆盖，所以在此加入一个别名--by lxf
        $this->CI->load->library('TCPDF/Tcpdf', null, 'my_tcpdf');

//        $this->tcpdf = $this->CI->my_tcpdf;
        $this->tcpdf = new TCPDF();
        $this->_this_time = date(DATE_ATOM);
    }

    public function create_pdf_sl_bbc($data) {
        $barcode_style =  array(
            'position' => '',
            'align' => 'L',
            'stretch' => false,
            'fitwidth' => false,
            'cellfitalign' => '',
            'border' => false,
            'hpadding' => 'auto',
            'vpadding' => 'auto',
            'fgcolor' => array(0,0,0),
            'bgcolor' => false,
            'text' => true,
            'font' => 'helvetica',
            'fontsize' => 18,
            'stretchtext' => 4
        );

        //面单信息
        $order_no = $data['sl_bbc_result']->order_no;
        $product_no = $data['sl_bbc_result']->product_no;
        // 转实体标签
        $brand = $data['sl_bbc_result']->brand = htmlspecialchars_decode($data['sl_bbc_result']->brand, ENT_QUOTES | ENT_HTML401);
        //pdf下载文件名
        $download_name = $order_no . 'SLBBC';

        //图片基本信息(都以单位长度)
        $start_x = 5; //起始位置x
        $start_y = 5; //起始位置Y
        $pdf_width = 200; //面单宽度
        $pdf_height= 155; //面单高度
        //--------调用tcpdf生成图片-----------------------------------
        //清除缓冲
        ob_clean();

        $pdf = $this->tcpdf;
        //设置文件title
        $pdf->SetTitle($download_name . '.pdf');
        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        //去除页眉
        $pdf->setPrintHeader(false);
        //去除页脚
        $pdf->setPrintFooter(false);
        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        // 设置左、上、右的间距
        //$pdf->SetMargins('5', '5', '5');
        // set font
        //支持中文格式
        $pdf->SetFont('stsongstdlightB', 'B', 20);
        // add a page
        $pdf->AddPage();
        //----------开始构建页面样式-------------------------------
        $pdf->SetFillColor(230, 110, 20);
        $line_margin = 0;
        //外框
        $pdf->MultiCell($pdf_width, $pdf_height, "", 1, 'C', 0, 0, $start_x, $start_y, true);

        //第一行 商品品类
        $pdf->SetFont('stsongstdlightB', 'M', 28,);
        $pdf->Text($start_x+10, $line_margin + 10, '品牌：'.$brand, false, 0,true,0,0,'C');


        //第二行 物流号条形码
        $line_margin += 15;
        $pdf->write1DBarcode($product_no, 'C128', 20, $start_y + $line_margin - 2, 180, 70, 1.3, $barcode_style, 'N');

        isset($barcode_style["fontsize"]) && ($barcode_style["fontsize"] = 14);

        //第三排 标识号条形码
        $line_margin += 70;
        $pdf->MultiCell(200, 70, "", 1, 'C', 0, 10, $start_x, $start_y + $line_margin, true);
        $pdf->write1DBarcode($order_no, 'C128', 40, $start_y + $line_margin + 10, 130, 50, 1.3, $barcode_style, 'N');

        $pdf->Output($download_name . '.pdf', 'I');

    }
}