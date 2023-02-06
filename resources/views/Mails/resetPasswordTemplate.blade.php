<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>Verify email</title>
    <meta name="description" content="Reset Password Email Template." />
    <style type="text/css">
      a:hover {
        text-decoration: underline !important;
      }
    </style>
  </head>

  <body
    marginheight="0"
    topmargin="0"
    marginwidth="0"
    style="margin: 0px; background-color: #f2f3f8;"
    leftmargin="0"
  >
    <!--100% body table-->
    <table
      cellspacing="0"
      border="0"
      cellpadding="0"
      width="100%"
      bgcolor="#f2f3f8"
      style="
        @import url(
          https://fonts.googleapis.com/css?family=Rubik:300,
          400,
          500,
          700|Open + Sans:300,
          400,
          600,
          700
        );
        font-family: 'Open Sans', sans-serif;
      "
    >
      <tr>
        <td>
          <table
            style="background-color: #f2f3f8; max-width: 670px; margin: 0 auto;"
            width="100%"
            border="0"
            align="center"
            cellpadding="0"
            cellspacing="0"
          >
            <tr>
              <td style="height: 80px;">&nbsp;</td>
            </tr>
            <tr>
              <td style="text-align: center;">
                <a
                  href="{{$data['url']}}"
                  title="thebrighterworld"
                  target="_blank"
                >
                  <img
                    height="90"
                    src="http://thebrighterworld.com/logo.png"
                    title="Thebrigherworld"
                    alt="Thebrigherworld"
                  />
                </a>
              </td>
            </tr>
            <tr>
              <td style="height: 20px;">&nbsp;</td>
            </tr>
            <tr>
              <td>
                <table
                  width="95%"
                  border="0"
                  align="center"
                  cellpadding="0"
                  cellspacing="0"
                  style="
                    max-width: 670px;
                    background: #fff;
                    border-radius: 3px;
                    text-align: center;
                    -webkit-box-shadow: 0 6px 18px 0 rgba(0, 0, 0, 0.06);
                    -moz-box-shadow: 0 6px 18px 0 rgba(0, 0, 0, 0.06);
                    box-shadow: 0 6px 18px 0 rgba(0, 0, 0, 0.06);
                  "
                >
                  <tr>
                    <td style="height: 40px;">
                      &nbsp;
                      <p style="font-weight: bold; font-size: 20px;">Hello <strong>{{$data['name']}}</strong></p>
                    </td>
                  </tr>
                  <tr>
                    <td style="padding: 0 35px;">
                      <h1
                        style="
                          color: #1e1e2d;
                          font-weight: 500;
                          margin: 0;
                          font-size: 32px;
                          font-family: 'Rubik', sans-serif;
                        "
                      ></h1>
                      <span
                        style="
                          display: inline-block;
                          vertical-align: middle;
                          margin: 29px 0 26px;
                          border-bottom: 1px solid #cecece;
                          width: 100px;
                        "
                      ></span>
                      <p
                        style="
                          color: black;
                          font-size: 20px;
                          line-height: 24px;
                          margin: 0;
                        "
                      >
                        We heard you need a password reset. Click the link below
                        and you'll be redirected to a secure site from which you
                        can a set password.
                      </p>
                      <a
                        href="{{$data['link']}}"
                        style="
                          background: #ffc107;
                          text-decoration: none !important;
                          font-weight: 500;
                          margin-top: 35px;
                          color: #fff;
                          text-transform: uppercase;
                          font-size: 14px;
                          padding: 10px 24px;
                          display: inline-block;
                          border-radius: 50px;
                        "
                        >Reset Password</a
                      >
                    </td>
                  </tr>
                  <tr>
                    <td style="height: 40px;">&nbsp;</td>
                  </tr>
                  <tr>
                    <td>
                      <p>
                        If you didn't try to reset your password.
                        <a href="" style="color: blue;"><u>click here</u></a>
                        and we'll forget this ever happend.
                      </p>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>

            <tr>
              <td style="height: 20px;">&nbsp;</td>
            </tr>
            <tr>
              <td style="text-align: center;">
                <p
                  style="
                    font-size: 14px;
                    color: rgba(69, 80, 86, 0.7411764705882353);
                    line-height: 18px;
                    margin: 0 0 0;
                  "
                >
                  &copy;
                  <strong
                    >Copyright 2022
                    <a href="{{$data['url']}}">The Brighter World</a>. All
                    rights reserved.</strong
                  >
                </p>
              </td>
            </tr>
            <tr>
              <td style="height: 80px;">&nbsp;</td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    <!--/100% body table-->
  </body>
</html>
