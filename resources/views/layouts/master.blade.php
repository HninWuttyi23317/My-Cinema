<!DOCTYPE html>
<html lang="en">

<head>

    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            /* font-family:'Times New Roman', Times, serif; */

        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 140vh;
            position: relative;
            background: rgb(200, 54, 105);
            background: radial-gradient(circle, rgb(187, 52, 100) 0%, #9d9d9d 69%, rgba(95, 88, 212, 1) 0211%);

        }

        /* img{
            position: absolute;
            height: 100%;
            width: 100%;
            object-fit: cover;
            z-index: -20;
        } */

         .box {
            position: relative;
            width: 500px;
            height: 600px;
            overflow: hidden;
            box-shadow: 0 0 30px rgb(149, 7, 16);
            z-index: 10;
        }

        .signup .box {
            width: 530px;
            height: 750px;
        }

        .signup .box::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 550px;
            height: 770px;
            background: linear-gradient(60deg, transparent, #200bdd, #455ce0);
            transform-origin: bottom right;
            animation: 4s linear infinite;
            animation-name: animate;
        }

        .signup .box::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 550px;
            height: 770px;
            background: linear-gradient(60deg, transparent, rgb(222, 239, 197), rgb(231, 239, 220));
            transform-origin: bottom right;
            animation: 4s linear infinite;
            animation-delay: -2s;
            animation-name: animate;
            /* animation-duration: -3s; */
        }

        .signin .box::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 520px;
            height: 620px;
            background: linear-gradient(60deg, transparent, #e7ddde, #dae0e8);
            transform-origin: bottom right;
            animation: 4s linear infinite;
            animation-name: animate;
            /* animation-duration: 6s; */
        }

        .signin .box::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 520px;
            height: 620px;
            background: linear-gradient(60deg, transparent, #3e50d6, #312eee);
            transform-origin: bottom right;
            animation: 4s linear infinite;
            animation-delay: -2s;
            animation-name: animate;
            /* animation-duration: -3s; */
        }

        @keyframes animate {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        form {
            position: absolute;
            inset: 4px;
            border-radius: 50px 0 50px 0;
            /* background: #400c02; */
            /* background: #440092; */
            background: rgb(24,15,15);
            background: linear-gradient(90deg, rgba(24,15,15,1) 45%, rgba(131,8,8,0.9217204384181811) 70%);
            z-index: 11;
            padding: 30px 30px;
            display: flex;
            flex-direction: column;
            /* opacity: 1; */
            transition: 0.5s;
        }

        .signup form {
            position: absolute;
            inset: 4px;
            border-radius: 50px 5px;
            /* background: #3d087b; */
            background: rgb(24,15,15);
            background: linear-gradient(90deg, rgba(24,15,15,1) 45%, rgba(131,8,8,0.9217204384181811) 70%);
            z-index: 11;
            padding: 30px 30px;
            display: flex;
            flex-direction: column;
            /* opacity: 1; */
            transition: 0.5s;
            /* filter: brightness(1); */
        }

        /* form:hover {
            filter: brightness(1.1);
        } */

        form h2 {
            color: #ffeded;
            font-size: 35px;
            font-weight: 500;
            text-align: center;
            text-shadow: 0 0 3px #FF0000, 0 0 5px #8800ff;
            cursor: pointer;

        }

        .inputBox {
            position: relative;
            width: 370px;
            margin-top: 35px;
            background: transparent;
            border: none;
        }

        .inputBox input {
            position: relative;
            width: 100%;
            padding: 10px 10px 10px;
            background: transparent;
            box-shadow: 2px 2px #a6dcef;
            font-size: 20px;
            font-weight: 550;
            letter-spacing: 0.05em;
            z-index: 10;
            font-size: 20px;
            border-radius: 10px;
            transition: 0.5s;
            filter: brightness(1);
        }

        form .inputBox input:hover {
            /* transform: translateY(-6px); */
            transform: scale(1.1);
            filter: brightness(1.2);
        }

        .signup .inputBox select {
            position: relative;
            width: 100%;
            padding: 10px 10px 10px;
            background: transparent;
            box-shadow: 2px 2px 2px #a6dcef;
            font-size: 20px;
            font-weight: 550;
            letter-spacing: 0.05em;
            z-index: 8;
            font-size: 20px;
            border-radius: 10px;
            transition: 0.5s;
            filter: brightness(1);
        }

        .signup .inputBox select:hover {

            transform: translateY(-6px);
            transform: scale(1.1);
            filter: brightness(1.2);
        }

        form div button {
            font-size: 20px;
            width: 100%;
            background: #4586ff;
            padding: 15px 0 15px 0;
            margin-top: 20px;
            border-radius: 20px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.5s;
        }

        form div button:hover {
            background: #00369b;
            color: #fff;
            transform: translateX(6px);
            filter: brightness(1.5);
        }

        form div button:active {
            background: linear-gradient(90deg, #5545ff, #d9138a);
            opacity: 0.8;
        }


        .links {
            display: flex;
            justify-content: space-between;

        }

        .links a {
            margin: 25px 0;
            font-size: 18px;
            font-weight: bold;
            color: #fff;
            text-decoration: none;
        }

        .icon {
            justify-content: center;
        }

        .icon span {
            cursor: pointer;
            font-size: 25px;
            color: #fff;
            padding-left: 15px;
        }

        .fb i {
            transition: 0.3s;
        }

        .fb i:hover {
            background: white;
            background-size: 5px;
            color: blue;
            font-size: 30px;
            text-shadow: 2px 2px 2px 2px rgb(179, 179, 255);
        }

        .ig i {
            transition: 0.3s;
        }

        .ig i:hover {
            background: linear-gradient(to bottom,#515bd4,#8134af,#dd2a7b,#feda77,#f58529);
            background-size: 6px;
            color:white;
            font-size: 32px;
            text-shadow: 2px 2px 2px 2px rgb(224, 224, 255);

        }

        .sk i {
            transition: 0.3s;
        }

        .sk i:hover {
            background: linear-gradient(to right,blue,#a6dcef);
            color: #19038a;
            font-size: 30px;
            text-shadow: 2px 2px 2px 2px rgb(212, 212, 255);
        }
    </style>

    {{-- bootstrap css --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<body>
    {{-- <img src="{{asset('user/img/bg3.jpg') }}" alt=""> --}}

    @yield('content')


</body>
{{-- bootstrap js --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</html>
<!-- end document-->
