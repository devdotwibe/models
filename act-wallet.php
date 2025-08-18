<?php
session_start();
include('includes/config.php');
include('includes/helper.php');


    if (isset($_SESSION["log_user_id"])) {

        $userDetails = get_data('model_user', ['id' => $_SESSION["log_user_id"]], true);

        $checkbankdetail = get_data('users_bankdetail', ['user_id' => $userDetails["id"]], true);

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'submit_withdrawal') {
            
            $per_amount = 50;

            $coin = isset($_POST['coin']) ? (int) $_POST['coin'] : 0;

            if ($coin <= 0) {

                echo json_encode(['status' => 'error', 'message' => 'Invalid withdrawal amount']);
                exit;
            }

            if (!$checkbankdetail) {

                echo json_encode(['status' => 'error', 'message' => 'No bank details found']);
                exit;
            }

            $table_name = 'users_withdrow_request';

            $post_data = [];

            $post_data['amount'] = round($coin / $per_amount, 2);

            $post_data['transaction_fee'] = 5;

            $post_data['account_name']   = $checkbankdetail['account_name'];
            $post_data['account_number'] = $checkbankdetail['account_number'];
            $post_data['bank_name']      = $checkbankdetail['bank_name'];
            $post_data['ifsc_code']      = $checkbankdetail['ifsc_code'];
            $post_data['upi_id']         = $checkbankdetail['upi_id'];

            $post_data['branch_name']  = '';
            $post_data['bank_address'] = '';
            $post_data['country']      = '';
            $post_data['swift_code']   = '';

            $post_data['user_id']      = $userDetails['id'];
            $post_data['created_date'] = date('Y-m-d H:i:s');

            DB::insert($table_name, $post_data);
            $created_id = DB::insertId();

            if ($created_id) {
                echo json_encode(['status' => 'success', 'message' => 'Withdrawal request submitted successfully']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to submit withdrawal request']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
        }
    }
    else
    {
          echo json_encode(['status'=>'success','message'=>'Withdraw Request Failled']);
    }

?>