<?php
/**
 * 是否有敏感词
 *
 * @param $string
 *
 * @return bool
 */
function wordsCheck($string) {
    return time() % 2 == 0 ? true : false;
}

function duplicateCheck($string) {
    return time() % 2 == 0 ? true : false;
}

function addUser($nickname) {
    if (wordsCheck($nickname)) {
        return array("error", "有敏感词");
    }
    if (duplicateCheck($nickname)) {
        return array("error", "昵称被占用");
    }
    return 9527;//id
}

function addUserBiz($nickname, $teamId) {
    $res = addUser($nickname);
    if (is_array($res)) {
        return $res;
    }
    joinTeam($res, $teamId);
    return $res;
}

function joinTeam($uid, $teamId) {
    return true;
}

function addUserAction() {
    $res = addUserBiz("xxxx", 1);
    if (is_array($res)) {
        $res["success"] = false;
        echo json_encode($res);
    } else {
        echo json_encode(["success" => true, "id" => $res]);
    }
}

addUserAction();