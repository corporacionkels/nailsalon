<!DOCTYPE html>

<html>
<head>
    <meta name="viewport" content="width=device-width" />
    <title>Alert </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <script type="text/javascript" charset="utf8" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>

    <table class="table table-bordered">
        <tr>
            <td style="width: 40%; vertical-align: middle;">
                Basic alert
            </td>
            <td>
                <button type="button" class="btn btn-info m-btn m-btn--custom" id="m_sweetalert_demo_1">
                    Show me
                </button>
            </td>
        </tr>
        <tr>
            <td style="width: 40%; vertical-align: middle;">
                Alert title and text
            </td>
            <td>
                <button type="button" class="btn btn-focus m-btn m-btn--custom" id="m_sweetalert_demo_2">
                    Show me
                </button>
            </td>
        </tr>
        <tr>
            <td style="width: 40%; vertical-align: middle;">
                Enable
                <code>
                    warning
                </code>
                ,
                <code>
                    error
                </code>
                ,
                <code>
                    success
                </code>
                ,
                <code>
                    info
                </code>
                and
                <code>
                    question
                </code>
                state icons
            </td>
            <td>
                <button type="button" class="btn btn-warning m-btn m-btn--custom" id="m_sweetalert_demo_3_1">
                    Warning
                </button>
                <button type="button" class="btn btn-danger m-btn m-btn--custom" id="m_sweetalert_demo_3_2">
                    Error
                </button>
                <button type="button" class="btn btn-success m-btn m-btn--custom" id="m_sweetalert_demo_3_3">
                    Success
                </button>
                <button type="button" class="btn btn-info m-btn m-btn--custom" id="m_sweetalert_demo_3_4">
                    Info
                </button>
                <button type="button" class="btn btn-metal m-btn m-btn--custom" id="m_sweetalert_demo_3_5">
                    Question
                </button>
            </td>
        </tr>
        <tr>
            <td style="width: 40%; vertical-align: middle;">
                Change confirm button text and class
            </td>
            <td>
                <button type="button" class="btn btn-success m-btn m-btn--custom" id="m_sweetalert_demo_4">
                    Show me
                </button>
            </td>
        </tr>
        <tr>
            <td style="width: 40%; vertical-align: middle;">
                Custom button with icon
            </td>
            <td>
                <button type="button" class="btn btn-danger m-btn m-btn--custom" id="m_sweetalert_demo_5">
                    Show me
                </button>
            </td>
        </tr>
        <tr>
            <td style="width: 40%; vertical-align: middle;">
                A custom positioned dialog with timer to auto close
            </td>
            <td>
                <button type="button" class="btn btn-success m-btn m-btn--custom" id="m_sweetalert_demo_6">
                    Show me
                </button>
            </td>
        </tr>
        <tr>
            <td style="width: 40%; vertical-align: middle;">
                jQuery HTML with custom animate.css animation
            </td>
            <td>
                <button type="button" class="btn btn-focus m-btn m-btn--custom" id="m_sweetalert_demo_7">
                    Show me
                </button>
            </td>
        </tr>
        <tr>
            <td style="width: 40%; vertical-align: middle;">
                A warning message, with a function attached to the confirm button
            </td>
            <td>
                <button type="button" class="btn btn-info m-btn m-btn--custom" id="m_sweetalert_demo_8">
                    Show me
                </button>
            </td>
        </tr>
        <tr>
            <td style="width: 40%; vertical-align: middle;">
                By passing a parameter, you can execute something else for cancel
            </td>
            <td>
                <button type="button" class="btn btn-danger m-btn m-btn--custom" id="m_sweetalert_demo_9">
                    Show me
                </button>
            </td>
        </tr>
        <tr>
            <td style="width: 40%; vertical-align: middle;">
                A message with a custom image and CSS animation disabled
            </td>
            <td>
                <button type="button" class="btn btn-warning m-btn m-btn--custom" id="m_sweetalert_demo_10">
                    Show me
                </button>
            </td>
        </tr>
        <tr>
            <td style="width: 40%; vertical-align: middle;">
                A message with auto close timer
            </td>
            <td>
                <button type="button" class="btn btn-metal m-btn m-btn--custom" id="m_sweetalert_demo_11">
                    Show me
                </button>
            </td>
        </tr>
    </table>
    <script>
        //== Class definition
        var SweetAlert2Demo = function () {

            //== Demos
            var initDemos = function () {
                //== Sweetalert Demo 1
                $('#m_sweetalert_demo_1').click(function (e) {
                    swal('Good job!');
                });

                //== Sweetalert Demo 2
                $('#m_sweetalert_demo_2').click(function (e) {
                    swal("Here's the title!", "...and here's the text!");
                });

                //== Sweetalert Demo 3
                $('#m_sweetalert_demo_3_1').click(function (e) {
                    swal("Good job!", "You clicked the button!", "warning");
                });

                $('#m_sweetalert_demo_3_2').click(function (e) {
                    swal("Good job!", "You clicked the button!", "error");
                });

                $('#m_sweetalert_demo_3_3').click(function (e) {
                    swal("Good job!", "You clicked the button!", "success");
                });

                $('#m_sweetalert_demo_3_4').click(function (e) {
                    swal("Good job!", "You clicked the button!", "info");
                });

                $('#m_sweetalert_demo_3_5').click(function (e) {
                    swal("Good job!", "You clicked the button!", "");
                });

                //== Sweetalert Demo 4
                $('#m_sweetalert_demo_4').click(function (e) {
                    swal({
                        title: "Good job!",
                        text: "You clicked the button!",
                        icon: "success",
                        confirmButtonText: "Confirm me!",
                        confirmButtonClass: "btn btn-focus m-btn m-btn--pill m-btn--air"
                    });
                });

                //== Sweetalert Demo 5
                $('#m_sweetalert_demo_5').click(function (e) {
                    swal({
                        title: "Good job!",
                        text: "You clicked the button!",
                        icon: "success",

                        confirmButtonText: "<span><i class='la la-headphones'></i><span>I am game!</span></span>",
                        confirmButtonClass: "btn btn-danger m-btn m-btn--pill m-btn--air m-btn--icon",

                        showCancelButton: true,
                        cancelButtonText: "<span><i class='la la-thumbs-down'></i><span>No, thanks</span></span>",
                        cancelButtonClass: "btn btn-secondary m-btn m-btn--pill m-btn--icon"
                    });
                });

                $('#m_sweetalert_demo_6').click(function (e) {
                    swal({
                        position: 'top-right',
                        type: 'success',
                        title: 'Your work has been saved',
                        showConfirmButton: false,
                        timer: 1500
                    });
                });

                $('#m_sweetalert_demo_7').click(function (e) {
                    swal({
                        title: 'jQuery HTML example',
                        html: $('<div>')
                            .addClass('some-class')
                            .text('jQuery is everywhere.'),
                        animation: false,
                        customClass: 'animated tada'
                    })
                });

                $('#m_sweetalert_demo_8').click(function (e) {
                    swal({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!'
                    }).then(function (result) {
                        if (result.value) {
                            swal(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                        }
                    });
                });

                $('#m_sweetalert_demo_9').click(function (e) {
                    swal({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'No, cancel!',
                        reverseButtons: true
                    }).then(function (result) {
                        if (result.value) {
                            swal(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                            // result.dismiss can be 'cancel', 'overlay',
                            // 'close', and 'timer'
                        } else if (result.dismiss === 'cancel') {
                            swal(
                                'Cancelled',
                                'Your imaginary file is safe :)',
                                'error'
                            )
                        }
                    });
                });

                $('#m_sweetalert_demo_10').click(function (e) {
                    swal({
                        title: 'Sweet!',
                        text: 'Modal with a custom image.',
                        imageUrl: 'https://unsplash.it/400/200',
                        imageWidth: 400,
                        imageHeight: 200,
                        imageAlt: 'Custom image',
                        animation: false
                    });
                });

                $('#m_sweetalert_demo_11').click(function (e) {
                    swal({
                        title: 'Auto close alert!',
                        text: 'I will close in 5 seconds.',
                        timer: 5000,
                        onOpen: function () {
                            swal.showLoading()
                        }
                    }).then(function (result) {
                        if (result.dismiss === 'timer') {
                            console.log('I was closed by the timer')
                        }
                    })
                });
            };

            return {
                //== Init
                init: function () {
                    initDemos();
                },
            };
        }();

        //== Class Initialization
        jQuery(document).ready(function () {
            SweetAlert2Demo.init();
        });
    </script>
</body>

</html>