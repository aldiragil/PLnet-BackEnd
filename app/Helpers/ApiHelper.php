<?php

namespace App\Helpers;

define('LOGIN_SUCCESS', 'Berhasil Masuk!');
define('LOGIN_FAILED', 'Gagal Masuk!');
define('LOGOUT_SUCCESS', 'Berhasil Keluar!');
define('LOGOUT_FAILED', 'Gagal Keluar!');
define('PASSWORD_MISMATCH', 'Kata Sandi Salah!');

define('REFRESH_TOKEN_SUCCESS', 'Refreh token berhasil!');
define('REFRESH_TOKEN_FAILED', 'Refresh token gagal!');
define('CHECK_TOKEN_SUCCESS', 'Check token berhasil!');
define('CHECK_TOKEN_FAILED', 'Check token gagal!');

define('USER_EXIST', 'Pengguna sudah terdaftar!');
define('USER_DOES_NOT_EXIST', 'Pengguna belum terdaftar!');

define('REGISTER_SUCCESS', 'Registrasi Sukses!');
define('REGISTER_FAILED', 'Registrasi Gagal!');

define('CREATE_SUCCESS', 'Berhasil dibuat!');
define('CREATE_FAILED', 'Gagal dibuat!');

define('EDIT_SUCCESS', 'Edit success!');
define('EDIT_FAILED', 'Edit failed!');
define('DELETE_SUCCESS', 'Delete success!');
define('DELETE_FAILED', 'Delete failed!');
define('DATA_SUBMITTED_FOR_APPROVAL', 'Data submitted for approval!');
define('APPROVE_SUCCESS', 'Approved!');
define('ALREADY_APPROVED', 'Already approved!');
define('REJECT_SUCCESS', 'Rejected!');
define('ALREADY_REJECTED', 'Already rejected!');
define('APPROVAL_FAILED', 'Approve / Reject failed!');
define('GET_SUCCESS', 'Get success!');
define('GET_FAILED', 'Get failed!');
define('DATA_NOT_FOUND', 'Data not found!');
define('UNAUTHORIZED_ACCESS', 'You are not authorized!');
define('ITEM_PERPAGE_LIMIT', 20);
define('NOTIFICATION_SUCCESS', 'Notification send success!');
define('NOTIFICATION_FAILED', 'Notification send failed!');
define('UPLOAD_SUCCESS', 'Upload success!');
define('UPLOAD_FAILED', 'Upload failed!');


class ApiHelper{
    
    protected static $response = [
        'message' => null,
        'data' => null
    ];
    
    public static function response($code = null, $success = null, $message = null, $data = null){
        
        self::$response = [
            "success" => $success,
            "message" => $message,
        ];

        if ($data !== null) {
            self::$response["data"] = $data;
        }

        return response()->json(self::$response,$code);
    }

}