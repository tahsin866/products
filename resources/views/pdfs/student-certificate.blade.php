<!DOCTYPE html>
<html dir="rtl" lang="ar">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta charset="UTF-8">
        <title>Student Certificate</title>
        <style type="text/css">
            body {
                    margin: 0;
                    font-size: 85%;
                }

                @font-face{
                    font-family: "My-custom-font";
                    src : url("solaimanLipi.ttf")
                }
                .custom-font{
                    font: normal 20px/18px My-custom-font;
                }

          </style>
    </head>
    <body>
        <div class=  "custom-font">
            {{ $studentDetails->Name }}
        </div>
        <div class="custom-font">
            {{ $studentDetails->Roll }}
        </div>
        <div class="custom-font">
            {{ $studentDetails->reg_id }}
        </div>
    </body>
</html>
