<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\OAuth2\Client\Provider\Google;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\OAuth;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use App\Models\User;
use App\Models\Employee;
use App\Models\Applications;

class MailController extends Controller
{
    private $email;
    private $name;
    private $client_id;
    private $client_secret;
    private $token;
    private $provider;
    private $sysemail;
    private $fromSystem;
    public function __construct()
    {
        $this->client_id = env('GOOGLE_API_CLIENT_ID');
        $this->client_secret = env('GOOGLE_API_CLIENT_SECRET');
        $this->token = env('SYSTEM_EMAIL_TOKEN');
        $this->sysemail = env('SYSTEM_EMAIL');
        $this->fromSystem = env('SYSTEM_NAME');
        $this->provider = new Google([
            'clientId' => $this->client_id,
            'clientSecret' => $this->client_secret,
        ]);
    }

    public function testemail(Request $request)
    {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 465;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->SMTPAuth = true;
            $mail->AuthType = 'XOAUTH2';
            $mail->setOAuth(
                new OAuth([
                    'provider' => $this->provider,
                    'clientId' => $this->client_id,
                    'clientSecret' => $this->client_secret,
                    'refreshToken' => $this->token,
                    'userName' => $this->sysemail,
                ])
            );
            $mail->setFrom($this->sysemail, $this->fromSystem);
            $mail->addAddress('reenjie17@gmail.com', 'reenjayCaimor');
            $mail->Subject = 'Job Interview Invitation';
            $mail->CharSet = PHPMailer::CHARSET_UTF8;
            $body = '<!DOCTYPE html>
            <html lang="en">
            
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">
                <title>Document</title>
            </head>
            
            <body style="background-color:#E3F4F4;">
            <div class="es-wrapper-color" style="padding:10px">
            <!--[if gte mso 9]>
                <v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
                    <v:fill type="tile" color="transparent" origin="0.5, 0" position="0.5, 0"></v:fill>
                </v:background>
            <![endif]-->
            <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0">
                <tbody>
                    <tr>
                        <td class="esd-email-paddings" valign="top">
                            <table class="es-content esd-footer-popover" cellspacing="0" cellpadding="0" align="center">
                                <tbody>
                                    <tr>
                                        <td class="esd-stripe" align="center" bgcolor="#cfe2f3" style="background-color: #cfe2f3;">
                                            <table class="es-content-body" width="590" cellspacing="0" cellpadding="0" align="center" style="background-color: transparent;">
                                                <tbody>
                                                    <tr>
                                                        <td class="esd-structure es-p30" align="left" bgcolor="#cfe2f3" style="background-color: #cfe2f3;">
                                                            <table cellspacing="0" cellpadding="0" width="100%">
                                                                <tbody>
                                                                    <tr class="es-visible-simple-html-only">
                                                                        <td class="esd-container-frame es-container-visible-simple-html-only" width="450" valign="top" align="center" esdev-config="h1">
                                                                            <table width="100%" cellspacing="0" cellpadding="0" bgcolor="#ffffff" style="background-color: #ffffff;padding:20px">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td align="left" class="esd-block-text es-p35">
                                                                                            <p style="line-height: 150%; font-size: 16px;">Hi <strong>Dennis Amit</strong></p>
                                                                                            <p style="line-height: 150%; color: #b22222; font-size: 15px;">You are invited for an interview for the position of Computer Programmer I that you have applied in Isabela City online job portal. Please find interview details in this email.</p>
                                                                                            <p style="line-height: 150%;"><br></p>
                                                                                            <p style="line-height: 150%; font-size: 16px;"><strong>&nbsp; <span style="font-size:15px;">Venue :</span></strong></p>
                                                                                            <p style="line-height: 150%; text-align: left; font-size: 15px;">&nbsp; &nbsp; <em>testVenue</em></p>
                                                                                            <p style="line-height: 150%;"><br></p>
                                                                                            <p style="line-height: 150%; text-align: center; font-size: 11px;">[ THIS IS AN AUTOMATED MESSAGE - PLEASE DO NOT REPLY DIRECTLY TO THIS EMAIL]</p>
                                                                                            <p style="line-height: 150%; text-align: center; font-size: 12px;"><br></p>
                                                                                         
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
            
            </body>
            
            </html>
            
           ';
            $mail->isHTML(true);
            $mail->Body = $body;
            $mail->AltBody = 'This is a plain text message body';
            if ($mail->send()) {
                echo 'send Successfully!';
            } else {
                echo 'not send';
            }
        } catch (Exception $e) {
            return $e;
        }
    }

    public function Resend_Interviewnotice(Request $request)
    {   
       
        $provider = $this->provider;
        $client_id = $this->client_id;
        $client_secret = $this->client_secret;
        $token = $this->token;
        $sysemail = $this->sysemail;
        $fromSystem = $this->fromSystem;
        function sendEmail(
            $arr,
            $provider,
            $client_id,
            $client_secret,
            $token,
            $sysemail,
            $fromSystem
        ) {
           
            if ($arr['interviewer'] == true) {
                //this is a interview content
                $info =
                    'You are invited for an interview for the position of ' .
                    $arr['jobtitle'] .
                    ' .Please find Applicant and interview details in this email.';

                $details =
                    ' 
                    <p style="line-height: 150%; font-size: 16px;"><strong>&nbsp; <span style="font-size:15px;">Applicant Details :</span></strong></p>
                <p style="line-height: 150%; text-align: left; font-size: 15px;">&nbsp; &nbsp; <em>' .
                    $arr['applicantName'] .
                    ' <br/> <span style="font-size:12px">'.$arr['applicantEmail'].' | # '.$arr['mobile_no'].'</span> </em></p>
                    
                    <p style="line-height: 150%; font-size: 16px;"><strong>&nbsp; <span style="font-size:15px;">Venue :</span></strong></p>
                <p style="line-height: 150%; text-align: left; font-size: 15px;">&nbsp; &nbsp; <em>' .
                    $arr['Venue'] .
                    ' </em></p>
<p style="line-height: 150%; font-size: 16px;"><strong>&nbsp; <span style="font-size:15px;">Date & Time  :</span></strong></p>
<p style="line-height: 150%; text-align: left; font-size: 15px;">&nbsp; &nbsp;<em style="color:red">' .
                    date('F j,Y h:ia ', strtotime($arr['interviewDate'])) .
                    '</em></p>';
            } else {
                $info =
                    'You are invited for an interview for the position of ' .
                    $arr['jobtitle'] .
                    ' that you have applied in Isabela City online job portal. Please find interview details in this email.';

                $details =
                    ' <p style="line-height: 150%; font-size: 16px;"><strong>&nbsp; <span style="font-size:15px;">Venue :</span></strong></p>
                <p style="line-height: 150%; text-align: left; font-size: 15px;">&nbsp; &nbsp; <em>' .
                    $arr['Venue'] .
                    '</em></p>
<p style="line-height: 150%; font-size: 16px;"><strong>&nbsp; <span style="font-size:15px;">Date & Time  :</span></strong></p>
<p style="line-height: 150%; text-align: left; font-size: 15px;">&nbsp; &nbsp;<em style="color:red">' .
                    date('F j,Y h:ia', strtotime($arr['interviewDate'])) .
                    '</em></p>';
            }

            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->SMTPDebug = SMTP::DEBUG_OFF;
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = 465;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->SMTPAuth = true;
                $mail->AuthType = 'XOAUTH2';
                $mail->setOAuth(
                    new OAuth([
                        'provider' => $provider,
                        'clientId' => $client_id,
                        'clientSecret' => $client_secret,
                        'refreshToken' => $token,
                        'userName' => $sysemail,
                    ])
                );
                $mail->setFrom($sysemail, $fromSystem);
                $mail->addAddress($arr['email'], $arr['Name']);
                $mail->Subject = 'Job Interview Invitation';
                $mail->CharSet = PHPMailer::CHARSET_UTF8;
                $body =
                    '<!DOCTYPE html>
                <html lang="en">

                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <meta http-equiv="X-UA-Compatible" content="ie=edge">
                    <title>Document</title>
                </head>

                <body style="background-color:#E3F4F4;">
                <div class="es-wrapper-color" style="padding:10px">
                <!--[if gte mso 9]>
                    <v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
                        <v:fill type="tile" color="transparent" origin="0.5, 0" position="0.5, 0"></v:fill>
                    </v:background>
                <![endif]-->
                <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0">
                    <tbody>
                        <tr>
                            <td class="esd-email-paddings" valign="top">
                                <table class="es-content esd-footer-popover" cellspacing="0" cellpadding="0" align="center">
                                    <tbody>
                                        <tr>
                                            <td class="esd-stripe" align="center" bgcolor="#cfe2f3" style="background-color: #cfe2f3;">
                                                <table class="es-content-body" width="590" cellspacing="0" cellpadding="0" align="center" style="background-color: transparent;">
                                                    <tbody>
                                                        <tr>
                                                            <td class="esd-structure es-p30" align="left" bgcolor="#cfe2f3" style="background-color: #cfe2f3;">
                                                                <table cellspacing="0" cellpadding="0" width="100%">
                                                                    <tbody>
                                                                        <tr class="es-visible-simple-html-only">
                                                                            <td class="esd-container-frame es-container-visible-simple-html-only" width="450" valign="top" align="center" esdev-config="h1">
                                                                                <table width="100%" cellspacing="0" cellpadding="0" bgcolor="#ffffff" style="background-color: #ffffff;padding:20px">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td align="left" class="esd-block-text es-p35">
                                                                                                <p style="line-height: 150%; font-size: 16px;">Hi <strong>' .
                    $arr['Name'] .
                    '</strong></p>
                                                                                                <p style="line-height: 150%; color: #b22222; font-size: 15px;">' .
                    $info .
                    '</p>
                                                                                                <p style="line-height: 150%;"><br></p>
                                                                                               ' .
                    $details .
                    '
                                                                                                <p style="line-height: 150%;"><br></p>
                                                                                                <p style="line-height: 150%; text-align: center; font-size: 11px;">[ THIS IS AN AUTOMATED MESSAGE - PLEASE DO NOT REPLY DIRECTLY TO THIS EMAIL]</p>
                                                                                                <p style="line-height: 150%; text-align: center; font-size: 12px;"><br></p>

                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

                </body>

                </html>

               ';
                $mail->isHTML(true);
                $mail->Body = $body;
                $mail->AltBody = 'This is a plain text message body';
                if ($mail->send()) {
                   // return 'send';
                } else {
                    echo 'not send';
                }
            } catch (Exception $e) {
                return $e;
            }
        }

        $recepient = $request->applicantemail;
        $applicantName = $request->applicantfullname;
        $appliedPosition = $request->appliedPosition;
        $venue = $request->venue;
        $interviewDate = $request->interviewDate;
        $mobile_no = $request->mobile_no;
        $jobtitle = $request->jobtitle;

        if(isset($request->resend)){
            $data = $request->data;
            $appdata = Applications::find($data['appID']);
            sendEmail(
                [
                    'email' => $data['applicantemail'],
                    'Name' =>   $data['applicantfullname'],
                    'Venue' => $appdata->venue,
                    'interviewDate' => $appdata->interview_date,
                    'jobtitle' => $jobtitle,
                    'interviewer' => false,
                ],
                $provider,
                $client_id,
                $client_secret,
                $token,
                $sysemail,
                $fromSystem
            );
            return "sentSuccessfully";
        }

        if (isset($request->interViewers)) {
            $interviewers = $request->interViewers;

            foreach ($interviewers as $hrmsID) {
                $hrdata = User::where('emp_id', $hrmsID)->first();
                $hremp = Employee::where('ID', $hrmsID)->first();
                sendEmail(
                    [
                        'email' => $hrdata->email,
                        'Name' => $hremp->firstname . ' ' . $hremp->lastname,
                        'Venue' => $venue,
                        'interviewDate' => $interviewDate,
                        'applicantName' => $applicantName,
                        'applicantEmail' => $recepient,
                        'mobile_no' => $mobile_no,
                        'jobtitle' => $jobtitle,
                        'interviewer' => true,
                    ],
                    $provider,
                    $client_id,
                    $client_secret,
                    $token,
                    $sysemail,
                    $fromSystem
                );
            }

            sendEmail(
                [
                    'email' => $recepient,
                    'Name' => $applicantName,
                    'Venue' => $venue,
                    'interviewDate' => $interviewDate,
                    'jobtitle' => $jobtitle,
                    'interviewer' => false,
                ],
                $provider,
                $client_id,
                $client_secret,
                $token,
                $sysemail,
                $fromSystem
            );

            return redirect()->back()->with('success','Interview Set successfully!');
        }
    }

    public function Resend_Acknowledgement(Request $request)
    {
        $data = $request->data;
        
        $recepient = $data['applicantemail'];
        $applicantName = $data['applicantfullname'];
        $appliedPosition = $data['jobtitle'];

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 465;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->SMTPAuth = true;
            $mail->AuthType = 'XOAUTH2';
            $mail->setOAuth(
                new OAuth([
                    'provider' => $this->provider,
                    'clientId' => $this->client_id,
                    'clientSecret' => $this->client_secret,
                    'refreshToken' => $this->token,
                    'userName' => $this->sysemail,
                ])
            );
            $mail->setFrom($this->sysemail, $this->fromSystem);
            $mail->addAddress($recepient, $applicantName);
            $mail->Subject = 'Application Notification';
            $mail->CharSet = PHPMailer::CHARSET_UTF8;
            $body =
                '<!DOCTYPE html>
            <html lang="en">
            
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">
                <title>Document</title>
            </head>
            
            <body style="background-color:#E3F4F4;">
            <div class="es-wrapper-color" style="padding:10px">
            <!--[if gte mso 9]>
                <v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
                    <v:fill type="tile" color="transparent" origin="0.5, 0" position="0.5, 0"></v:fill>
                </v:background>
            <![endif]-->
            <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0">
                <tbody>
                    <tr>
                        <td class="esd-email-paddings" valign="top">
                            <table class="es-content esd-footer-popover" cellspacing="0" cellpadding="0" align="center">
                                <tbody>
                                    <tr>
                                        <td class="esd-stripe" align="center" bgcolor="#cfe2f3" style="background-color: #cfe2f3;">
                                            <table class="es-content-body" width="590" cellspacing="0" cellpadding="0" align="center" style="background-color: transparent;">
                                                <tbody>
                                                    <tr>
                                                        <td class="esd-structure es-p30" align="left" bgcolor="#cfe2f3" style="background-color: #cfe2f3;">
                                                            <table cellspacing="0" cellpadding="0" width="100%">
                                                                <tbody>
                                                                    <tr class="es-visible-simple-html-only">
                                                                        <td class="esd-container-frame es-container-visible-simple-html-only" width="450" valign="top" align="center" esdev-config="h1">
                                                                            <table width="100%" cellspacing="0" cellpadding="0" bgcolor="#ffffff" style="background-color: #ffffff;padding:20px">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td align="left" class="esd-block-text es-p35">
                                                                                            <p style="line-height: 150%; font-size: 16px;">Hi <strong>' .
                $applicantName .
                '</strong></p>
                                                                                            <p style="line-height: 150%; color: #b22222; font-size: 15px;">This is to notify you that you have successfully applied for ' .
                $appliedPosition .
                ' position in Isabela City online job portal. Please check your email or portal from time to time for application status updates.</p>
                                                                                            <p style="line-height: 150%;"><br></p>
                                                                                            <p style="line-height: 150%;"><br></p>
                                                                                            <p style="line-height: 150%; text-align: center; font-size: 11px;">[ THIS IS AN AUTOMATED MESSAGE - PLEASE DO NOT REPLY DIRECTLY TO THIS EMAIL]</p>
                                                                                            <p style="line-height: 150%; text-align: center; font-size: 12px;"><br></p>
                                                                                         
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
            
            </body>
            
            </html>
            
           ';
            $mail->isHTML(true);
            $mail->Body = $body;
            $mail->AltBody = 'This is a plain text message body';
            if ($mail->send()) {
                return 'sentSuccessfully';
            } else {
                echo 'not send';
            }
        } catch (Exception $e) {
            return $e;
        }
    }

    public function sendOTP(Request $request){
    
            $sess = session()->get('otp');
            $email = $sess['email'];
            $Username = $sess['Username'];
            $otpcode = $sess['otpCode'];
            
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->SMTPDebug = SMTP::DEBUG_OFF;
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = 465;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->SMTPAuth = true;
                $mail->AuthType = 'XOAUTH2';
                $mail->setOAuth(
                    new OAuth([
                        'provider' => $this->provider,
                        'clientId' => $this->client_id,
                        'clientSecret' => $this->client_secret,
                        'refreshToken' => $this->token,
                        'userName' => $this->sysemail,
                    ])
                );
                $mail->setFrom($this->sysemail, $this->fromSystem);
                $mail->addAddress($email,$Username);
                $mail->Subject = 'One Time Pin';
                $mail->CharSet = PHPMailer::CHARSET_UTF8;
                $body = 
               
               '
               <!DOCTYPE html>
               <html lang="en">
               
               <head>
                   <meta charset="UTF-8">
                   <meta name="viewport" content="width=device-width, initial-scale=1.0">
                   <meta http-equiv="X-UA-Compatible" content="ie=edge">
                   <title>Document</title>
               </head>
               
               <body style="background-color:#EADBC8;padding:50px">
               <div class="es-wrapper-color" style="padding:10px">
               <!--[if gte mso 9]>
                   <v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
                       <v:fill type="tile" color="transparent" origin="0.5, 0" position="0.5, 0"></v:fill>
                   </v:background>
               <![endif]-->
               <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0">
                   <tbody>
                       <tr>
                           <td class="esd-email-paddings" valign="top">
                               <table class="es-content esd-footer-popover" cellspacing="0" cellpadding="0" align="center">
                                   <tbody>
                                       <tr>
                                           <td class="esd-stripe" align="center" bgcolor="#F0F0F0" style="background-color: #F0F0F0;">
                                               <table class="es-content-body" width="590" cellspacing="0" cellpadding="0" align="center" style="background-color: transparent;">
                                                   <tbody>
                                                       <tr>
                                                           <td class="esd-structure es-p30" align="left" bgcolor="#F0F0F0" style="background-color: #F0F0F0;">
                                                               <table cellspacing="0" cellpadding="0" width="100%">
                                                                   <tbody>
                                                                       <tr class="es-visible-simple-html-only">
                                                                           <td class="esd-container-frame es-container-visible-simple-html-only" width="450" valign="top" align="center" esdev-config="h1">
                                                                               <table width="100%" cellspacing="0" cellpadding="0" bgcolor="#F0F0F0" style="background-color: #F0F0F0;padding:20px">
                                                                                   <tbody>
                                                                                       <tr>
                                                                                           <td align="left" class="esd-block-text es-p35">
                                                                                               <p style="line-height: 150%; font-size: 14px;color:#213555">Your OTP Code is :</strong></p>
                                                                                               <p style="line-height: 150%; color: #213555; font-size: 30px;text-align:center">'.$otpcode.'</p>
                                                                                               <p style="line-height: 150%;"><br></p>
                                                                                           
                                                                                               <p style="line-height: 150%;text-align: center; font-size: 11px;color:#213555"><br>Dont share this message to anyone.</p>
                                                                                               <p style="line-height: 150%; text-align: center; font-size: 11px;color:#213555">[ THIS IS AN AUTOMATED MESSAGE - PLEASE DO NOT REPLY DIRECTLY TO THIS EMAIL]</p>
                                                                                               <p style="line-height: 150%; text-align: center; font-size: 12px;"><br></p>
                                                                                            
                                                                                           </td>
                                                                                       </tr>
                                                                                   </tbody>
                                                                               </table>
                                                                           </td>
                                                                       </tr>
                                                                   </tbody>
                                                               </table>
                                                           </td>
                                                       </tr>
                                                   </tbody>
                                               </table>
                                           </td>
                                       </tr>
                                   </tbody>
                               </table>
                           </td>
                       </tr>
                   </tbody>
               </table>
           </div>
               
               </body>
               
               </html>
               
               
               
               ';
                $mail->isHTML(true);
                $mail->Body = $body;
                $mail->AltBody = 'This is a plain text message body';
                if ($mail->send()) {
                  //session()->forget('otp');
                  session(['otpSend'=>true]);
                   return redirect()->back();
                } else {
                    return response()->json(['message'=>'errorsending']);
                }
            } catch (Exception $e) {
                return $e;
            }


      
    }
}
