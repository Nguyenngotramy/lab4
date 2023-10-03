<?php
use Vtiful\Kernel\Format;
//set default value
$message = '';

//get value from POST array
$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action =  'start_app';
}

//process
switch ($action) {
    case 'start_app':

        // set default invoice date 1 month prior to current date
        $interval = new DateInterval('P1M');
        $default_date = new DateTime();
        $default_date->sub($interval);
        $invoice_date_s = $default_date->format('n/j/Y');

        // set default due date 2 months after current date
        $interval = new DateInterval('P2M');
        $default_date = new DateTime();
        $default_date->add($interval);
        $due_date_s = $default_date->format('n/j/Y');

        $message = 'Enter two dates and click on the Submit button.';
        break;
    case 'process_data':
        $invoice_date_s = filter_input(INPUT_POST, 'invoice_date');
        $due_date_s = filter_input(INPUT_POST, 'due_date');
      
        // make sure the user enters both dates
        if (!empty($invoice_date_s) && !empty($due_date_s)){
        // convert date strings to DateTime objects
        $invoice_date_strtodat = strtotime($invoice_date_s);
        $due_date_strtodat = strtotime($due_date_s);
        // and use a try/catch to make sure the dates are valid
        try{
        // make sure the due date is after the invoice date

        // format both dates
       
        $invoice_date_f = date('F d, Y',  $invoice_date_strtodat);
        $due_date_f = date('F d, Y',$due_date_strtodat); 
       
        // get the current date and time and format it
        $current_date_f = date ('F d,Y');
        $current_time_f = date ('H:i:s');
       
        // get the amount of time between the current date and the due date
        $date = abs($invoice_date_strtodat-$due_date_strtodat);
        $year = floor($date/(365*24*60*60));
        $month = floor(($date - $year*365*60*24*60)/(30*60*60*24));
        $day=floor(($date- $year*365*60*24*60 - $month*30*60*60*24)/(60*24*60));
        // and format the due date message
        $due_date_message = 'This invoice is due in '.$year.' years, '.$month.' months and '.$day.' days ';
        } catch(Exception $e) {

        }
        }
        break;
}
include 'date_tester.php';
?>