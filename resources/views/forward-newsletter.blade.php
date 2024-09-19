<html>

<head>
    <title>Foward E-News to Recommend person | Zagro Australia</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <style type="text/css">
        a:link {
            font-family: verdana;
            font-weight: normal;
            font-size: 11px;
            color: #000000;
            text-decoration: none;
        }

        a:visited {
            font-family: verdana;
            font-weight: normal;
            font-size: 11px;
            color: #000000;
            text-decoration: none;
        }

        a:hover {
            font-family: verdana;
            font-weight: normal;
            font-size: 11px;
            color: #ff9900;
            text-decoration: none;
        }

        .boldVerdana14pxTitle {
            font-family: verdana;
            font-weight: bold;
            font-size: 14px;
            color: #ffffff;
        }

        hr {
            border: none;
            border-top: 1px dotted #2d9948;
            color: #fff;
            background-color: #fff;
            height: 1px;
            width: 100%;
        }

        body {
            padding-top: 10px;
        }
    </style>
</head>

<body>

    <div class="mb-3 mx-5">
        <table width="100%" border="0" cellspacing="0" cellpadding="3" valign="top">
            <tr>
                <td>
                    <!-- <img src="/images/tran.gif" width="978" height="1" border="0"> -->
                    <a href="{{url('/')}}"><img style='width: 187px; height: 66px'
                            src="{{ Storage::url(setting('site.logo')) }}" class="img-fluid" alt="Brand" /></a>
                </td>
            </tr>
        </table>
    </div>

    <div class="mx-5">
        <table width="100%" border="0" cellspacing="0" cellpadding="5">
            <tr bgcolor="#1fbe4f">
                <td class="whiteHdrTitle">Recommend Zagro Australia e-News to Your Friends</td>
            </tr>
        </table>
    </div>

    <div class="mx-5 pt-3">
        <table>
            <tr>
                <td class="grayHdrText" colspan="5"><b>Please submit the names and email addresses of the persons whom
                        you wish to recommend the e-News to.</b></td>
            </tr>
        </table>
    </div>

    <!-- <table width="100%" border="0" cellspacing="2" cellpadding="0"> -->
    <div class="mx-5">

        @include('partials.error')
        @include('partials.flash')
        @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
        @endif

        <form class="newsletter" action="{{url('/forward')}}" method="POST">
            {{ csrf_field() }}
            <table width="100%" border="0" cellspacing="2" cellpadding="4">
                <tr>
                    <td colspan="5">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td>
                                    <hr>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class="grayHdrText">
                    <td width="10" rowspan="2">1.</td>
                    <td width="100" nowrap>First Name :</td>
                    <td width="50%"><input type="text" name="firstName[]" autocomplete="off"
                            style="width:100%;font-size:12px;color:#000000;border:1 solid #61C756" required=""></td>
                    <td width="100" nowrap>Last Name :</td>
                    <td width="50%"><input type="text" name="lastName[]" autocomplete="off"
                            style="width:100%;font-size:12px;color:#000000;border:1 solid #61C756" required=""></td>
                </tr>
                <tr class="grayHdrText">
                    <td>Email :</td>
                    <td colspan="3"><input type="email" name="email[]" autocomplete="off"
                            style="width:100%;font-size:12px;color:#000000;border:1 solid #61C756" required=""></td>
                </tr>

                <tr>
                    <td colspan="5">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td>
                                    <hr>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class="grayHdrText">
                    <td width="10" rowspan="2">2.</td>
                    <td width="100" nowrap>First Name :</td>
                    <td width="50%"><input type="text" name="firstName[]" autocomplete="off"
                            style="width:100%;font-size:12px;color:#000000;border:1 solid #61C756"></td>
                    <td width="100" nowrap>Last Name :</td>
                    <td width="50%"><input type="text" name="lastName[]" autocomplete="off"
                            style="width:100%;font-size:12px;color:#000000;border:1 solid #61C756"></td>
                </tr>
                <tr class="grayHdrText">
                    <td>Email :</td>
                    <td colspan="3"><input type="email" name="email[]" autocomplete="off"
                            style="width:100%;font-size:12px;color:#000000;border:1 solid #61C756"></td>
                </tr>

                <tr>
                    <td colspan="5">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td>
                                    <hr>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class="grayHdrText">
                    <td width="10" rowspan="2">3.</td>
                    <td width="100" nowrap>First Name :</td>
                    <td width="50%"><input type="text" name="firstName[]" autocomplete="off"
                            style="width:100%;font-size:12px;color:#000000;border:1 solid #61C756"></td>
                    <td width="100" nowrap>Last Name :</td>
                    <td width="50%"><input type="text" name="lastName[]" autocomplete="off"
                            style="width:100%;font-size:12px;color:#000000;border:1 solid #61C756"></td>
                </tr>
                <tr class="grayHdrText">
                    <td>Email :</td>
                    <td colspan="3"><input type="email" name="email[]" autocomplete="off"
                            style="width:100%;font-size:12px;color:#000000;border:1 solid #61C756"></td>
                </tr>

                <tr>
                    <td colspan="5">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td>
                                    <hr>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class="grayHdrText">
                    <td width="10" rowspan="2">4.</td>
                    <td width="100" nowrap>First Name :</td>
                    <td width="50%"><input type="text" name="firstName[]" autocomplete="off"
                            style="width:100%;font-size:12px;color:#000000;border:1 solid #61C756"></td>
                    <td width="100" nowrap>Last Name :</td>
                    <td width="50%"><input type="text" name="lastName[]" autocomplete="off"
                            style="width:100%;font-size:12px;color:#000000;border:1 solid #61C756"></td>
                </tr>
                <tr class="grayHdrText">
                    <td>Email :</td>
                    <td colspan="3"><input type="email" name="email[]" autocomplete="off"
                            style="width:100%;font-size:12px;color:#000000;border:1 solid #61C756"></td>
                </tr>
                <tr>
                    <td colspan="5">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td>
                                    <hr>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class="grayHdrText">
                    <td colspan="2" nowrap>Your Name :</td>
                    <td colspan="3"><input type="text" name="fromName" value=""
                            style="width:100%;font-size:12px;color:#000000;border:1 solid #61C756" required=""></td>
                </tr>
                <tr class="grayHdrText">
                    <td colspan="2" nowrap>Your Email :</td>
                    <td colspan="3"><input type="email" name="fromEmail" value=""
                            style="width:100%;font-size:12px;color:#000000;border:1 solid #61C756" required=""></td>
                </tr>
                <tr>
                    <td colspan="5">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <input type="hidden" name="newsletter_sidebar" value='true'>
            <input type="hidden" name="g_recaptcha_response_newsletter_sidebar">
            <script
                src="https://www.google.com/recaptcha/api.js?render={{ config('app.recaptcha.site_key') }}"></script>
            <script>
                grecaptcha.ready(function () {
                    grecaptcha.execute("{{ config('app.recaptcha.site_key') }}", { action: 'newsletter_sidebar' })
                        .then(function (token) {
                            //console.log(token)
                            document.querySelector('input[name=g_recaptcha_response_newsletter_sidebar]').value = token
                        })
                })  
            </script>
            <table width="100%" border="0" cellspacing="0" cellpadding="5">
                <tr bgcolor="#1fbe4f">
                    <td align="center">
                        <input type="submit" width="65" height="18" border="0" hspace="10" onMouseOver="btnover(this);"
                            onMouseOut="btnout(this);" style="cursor:hand;" class="btn btn-success btn-sm" name=""
                            value="Submit">
                        <input type="reset" width="52" height="18" border="0" hspace="10" onMouseOver="btnover(this);"
                            onMouseOut="btnout(this);" style="cursor:hand;" class="btn btn-secondary btn-sm" name=""
                            value="Reset">
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <!-- </table> -->
    <table id="tblFooter" width="100%" border="0" cellspacing="0" cellpadding="0" class="footerborder"
        style="text-align:center">
        <tr>
            <td class="qlpadding"><a href="{{url('/')}}" target="_self">Home</a> | <a href="{{url('/about-zagro')}}"
                    target="_self">About Us</a> | <a href="{{url('/contact-us')}}" target="_self">Contact Us</a> |<a
                    href="{{url('/join-as-strategic-partner')}}" target="_self">Partner with Us</a><br>Copyright
                &copy;2022 Zagro Australia. All rights reserved.<a href="{{url('/terms-and-conditions')}}">Terms and
                    Conditions</a><br></td>
        </tr>
    </table>
</body>

</html>
@section('js')
<script type="text/javascript">

    function GetStates(e) {
        // var e = document.getElementById("country_id");
        var country = e.options[e.selectedIndex].text;
        $('#country').val(country);

        id = e.options[e.selectedIndex].value;
        var url = "<?php echo url('/'); ?>";
        url = url + '/get-states';
        $.ajax({
            type: "GET",
            url: url,
            data: { 'id': id },
            cache: false,
            success: function (data) {
                // console.log('test: '+data[0]);
                $('#state').empty();
                $('#state').append("<option value=''>Select</option>");
                $.each(data, function (index, value) {
                    $('#state').append("<option value='" + value.name + "'>" + value.name + "</option>");
                });
            }
        });
    }

</script>
@stop