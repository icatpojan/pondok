<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Scripts -->
    <script src="https://unpkg.com/tailwindcss-jit-cdn"></script>
    <title>Office Kapal Pintar</title>
</head>
<body class="font-content text-foreground-black text-sm-content">
    <header class="w-full flex justify-center fixed z-50 transition duration-300" id="navbar">
        <div class="xl:w-1140 lg:w-960 md:w-720 w-540 px-4">
            <nav class="flex flex-row justify-between py-2 px-4 items-center">
                <a href="{{ route('welcome') }}" class="py-[5px]">
                    <img src="https://www.kapalpintar.com/assets/images/logokplpntr.png" width="195">
                </a>
                <a href="{{ route('login') }}" class="py-2 px-5 border-[1px] border-accent-green rounded-md text-accent-green font-medium xl:hover:text-white xl:hover:bg-accent-green xl:transition xl:duration-300">
                    Login
                </a>
            </nav>
        </div>
    </header>
    <section class="relative h-screen w-full py-[9.375rem]">
        <img src="https://www.kapalpintar.com/assets/images/backgrounds/contact-bg.png" class="w-full absolute bottom-0 left-0 z-0">
        <div class="flex md:flex-row flex-col relative z-10 xl:max-w-1140 lg:max-w-960 md:max-w-720 max-w-540 mx-auto items-center justify-center flex-wrap md:mb-[7.8125rem]">
            <div class="md:flex-4 md:pr-4 text-center sm:text-left">
                <h1 class="text-5xl-content text-accent-yellow mb-6">
                    <strong>Office Kapal Pintar</strong>
                </h1>
                <p class="text-foreground-gray">
                    Aplikasi PT. Kapal Pintar yang menangani manajemen inventaris dan memonitoring keluar masuknya
                    barang.
                </p>
            </div>
            <div class="md:flex-8 md:pl-4">
                <img src="{{ asset('welcome-page/kapal.svg') }}" class="w-full">
            </div>
        </div>
        <div class="relative z-10 xl:max-w-1140 lg:max-w-960 md:max-w-720 max-w-540 mx-auto">
            <ul class="text-center">
                <li class="inline-block mr-2 px-4">
                    <img src="https://kapalpintar.co.id/assets/images/clients-logo/iridium.png" class="max-w-full">
                </li>
                <li class="inline-block px-4">
                    <img src="https://kapalpintar.co.id/assets/images/clients-logo/globalstart.png" class="max-w-full">
                </li>
            </ul>
        </div>
    </section>
    <footer class="w-full h-full relative text-foreground-gray">
        <img src="https://kapalpintar.co.id/assets/images/backgrounds/footer-bg.png" class="max-w-full h-auto w-full absolute bottom-0 right-0 z-0" alt="footer">
        <div class="xl:max-w-1140 lg:max-w-960 md:max-w-720 max-w-540 w-full flex flex-col items-center justify-between z-10 relative mx-auto">
            <div class="w-full h-full flex flex-col md:flex-row mb-[6.25rem] flex-wrap">
                <div class="flex-5 md:pl-[0.9375rem] md:pr-12 px-[0.9375rem] max-w-540 md:max-w-720 lg:max-w-960 xl:max-w-1140 flex flex-col mb-12 md:mb-0">
                    <img src="https://www.kapalpintar.com/assets/images/logokplpntr.png" class="mb-6" width="195">
                    <span class="block mb-3">
                        Menjadi perusahaan telekomunikasi satelit (Provider) yang mengedepankan solusi kepada pengguna
                        maritime yang selalu
                        dikembangkan sesuai dengan kemajuan teknologi dan kebutuhan.
                    </span>
                </div>
                <div class="flex flex-row flex-7 md:px-0 px-[0.9375rem]">
                    <div class="md:flex-7 flex-4 sm:px-[0.9375rem] mb-2.5 sm:mb-0">
                        <h6 class="text-foreground-black sm:mb-6 mb-3 text-base">Quick Links</h6>
                        <ul>
                            <li class="mb-2.5">
                                <a href="#" class="xl:hover:text-accent-red py-[0.3125rem] xl:transition xl:duration-300">About</a>
                            </li>
                            <li class="mb-2.5">
                                <a href="#" class="xl:hover:text-accent-red py-[0.3125rem] xl:transition xl:duration-300">Service</a>
                            </li>
                            <li class="mb-2.5">
                                <a href="#" class="xl:hover:text-accent-red py-[0.3125rem] xl:transition xl:duration-300">Contact</a>
                            </li>
                        </ul>
                    </div>
                    <div class="md:flex-5 flex-8 -ml-2.5 sm:px-[0.9375rem] flex flex-col items-start justify-center">
                        <img src="https://kapalpintar.co.id/assets/images/ssl.png">
                        <h6 class="text-base text-foreground-black ml-2.5 leading-[1.2]">Secure And Authentic Website
                        </h6>
                        <label class="text-foreground-gray ml-2.5 leading-[1.2]">by Comodo CA Ltd</label>
                    </div>
                </div>
            </div>
            <div class="w-full flex justify-center pb-12">
                | @2020&nbsp;
                <a href="https://kapalpintar.co.id" target="_blank" referrerpolicy="no-referrer" class="text-accent-green font-medium">
                    Kapal Pintar
                </a>
                &nbsp;All Rights Reserved |
            </div>
        </div>

    </footer>
    <!-- Javascripts -->
    <script>
        const navbar = document.getElementById("navbar");

        window.onscroll = function() {
            (function() {
                if (document.documentElement.scrollTop > 1) {
                    navbar.style.backgroundColor = "#FFF";
                } else {
                    navbar.style.backgroundColor = null;
                }
            }())
        }

    </script>

    <!-- TailwindCss Config Script -->
    <script type="tailwind-config">
        {
        theme: {
            extend: {
            fontFamily: {
                "content": ["Quicksand", "sans-serif"]
            },
            colors: {
                "accent-yellow": "#FFBB33",
                "accent-green": "#1E858B",
                "accent-red": "#FF3158",
                "foreground-gray": "#999999",
                "foreground-black": "#222222"
            },
            maxWidth: {
                "540": "540px",
                "720": "720px",
                "960": "960px",
                "1140": "1140px",
            },
            width: {
                "540": "540px",
                "720": "720px",
                "960": "960px",
                "1140": "1140px",
            },
            fontSize: {
                "sm-content": ["0.9375rem", {
                lineHeight: "1.7"
                }],
                "5xl-content": ["3.4375rem", {
                lineHeight: "1"
                }]
            },
            flex: {
                "9": "0 0 75%",
                "8": "0 0 66.666667%",
                "7": "0 0 58.333333%",
                "5": "0 0 41.666667%",
                "4": "0 0 33.333333%",
                "3": "0 0 25%",
            },
            }
        }
        }
    </script>
</body>

</html>
