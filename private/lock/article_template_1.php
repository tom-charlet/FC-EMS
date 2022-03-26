<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400;700&family=Roboto:wght@300;400;500;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" media="screen" href="../css/style.css">
    <link rel="stylesheet" media="screen" href="../css/media-queries.css">
    <title>FC EMS - Nom Actualité</title> <!-- Modifier nom article en back -->
</head>

<body>

    <!-- HEADER -->

    <header>

        <!-- HEADER TOP -->

        <div class="header-top">
            <a href="../index.html" class="header-link">
                <div class="logo-team-m">
                    <img class="img-contain" src="../img/logo-ems.png" alt="logo fc eure madrie seine">
                </div>
                <h1 class="header-title">Football Club Eure Madrie Seine</h1>
            </a>
            <button class="header-burger-icon">
                <span></span>
            </button>
        </div>

        <!-- HEADER NAV -->

        <nav class="header-nav no-scroll-bar">
            <ul>

                <!-- ACCEUIL -->

                <li>
                    <a href="../index.html">
                        <div class="bloc-icon">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M15.7926 8.25228L8.59343 0.253172C8.29026 -0.0843906 7.70793 -0.0843906 7.40476 0.253172L0.205564 8.25228C0.101941 8.36714 0.033923 8.50964 0.00978135 8.66244C-0.0143603 8.81524 0.00641428 8.97177 0.0695792 9.11298C0.197565 9.40175 0.483933 9.58733 0.799898 9.58733H2.39972V15.1867C2.39972 15.3989 2.48399 15.6023 2.63401 15.7523C2.78402 15.9023 2.98748 15.9866 3.19963 15.9866H5.59936C5.81151 15.9866 6.01497 15.9023 6.16498 15.7523C6.315 15.6023 6.39927 15.3989 6.39927 15.1867V11.9871H9.59891V15.1867C9.59891 15.3989 9.68319 15.6023 9.8332 15.7523C9.98322 15.9023 10.1867 15.9866 10.3988 15.9866H12.7986C13.0107 15.9866 13.2142 15.9023 13.3642 15.7523C13.5142 15.6023 13.5985 15.3989 13.5985 15.1867V9.58733H15.1983C15.3532 9.58799 15.505 9.54356 15.6351 9.45946C15.7652 9.37536 15.868 9.25522 15.931 9.1137C15.994 8.97217 16.0145 8.81537 15.9899 8.66241C15.9653 8.50945 15.8968 8.36695 15.7926 8.25228Z"
                                    fill="#0A314E" />
                            </svg>
                            <span>acceuil</span>
                        </div>
                    </a>
                    <span class="split-bar"></span>
                </li>

                <!-- RESULTATS -->

                <li class="header-nav-active">
                    <a href="resultats.html">
                        <div class="bloc-icon">
                            <svg width="16" height="15" viewBox="0 0 16 15" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M12.8 5.6H10.8C10.36 5.6 10 5.96 10 6.4V9.6C10 10.04 10.36 10.4 10.8 10.4H12.8C13.24 10.4 13.6 10.04 13.6 9.6V6.4C13.6 5.96 13.24 5.6 12.8 5.6ZM12.4 9.2H11.2V6.8H12.4V9.2ZM6 10.4H2.4V8.4C2.4 7.96 2.76 7.6 3.2 7.6H4.8V6.8H2.4V5.6H5.2C5.64 5.6 6 5.96 6 6.4V7.6C6 8.04 5.64 8.4 5.2 8.4H3.6V9.2H6V10.4ZM8.6 7.2H7.4V6H8.6V7.2ZM8.6 10H7.4V8.8H8.6V10ZM16 3.2V12.8C16 13.68 15.28 14.4 14.4 14.4H1.6C0.72 14.4 0 13.68 0 12.8V3.2C0 2.32 0.72 1.6 1.6 1.6H4V0H5.6V1.6H10.4V0H12V1.6H14.4C15.28 1.6 16 2.32 16 3.2ZM14.4 12.8V3.2H8.6V4.4H7.4V3.2H1.6V12.8H7.4V11.6H8.6V12.8H14.4Z"
                                    fill="#24354D" />
                            </svg>
                            <span>résultats</span>
                        </div>
                    </a>
                    <span class="split-bar"></span>
                </li>

                <!-- CONVOCATIONS -->

                <li>
                    <a href="#">
                        <div class="bloc-icon">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M11.4435 0.0229734C11.5619 0.0601127 11.6598 0.140161 11.7158 0.245513C11.7717 0.350865 11.7811 0.472892 11.7418 0.584756L11.2713 1.9181C11.2318 2.03008 11.1469 2.12268 11.0352 2.17552C10.9235 2.22837 10.7941 2.23713 10.6756 2.19988C10.557 2.16263 10.459 2.08243 10.4031 1.9769C10.3471 1.87138 10.3378 1.74919 10.3773 1.63721L10.8478 0.303865C10.8673 0.248457 10.8983 0.197234 10.9388 0.153124C10.9793 0.109015 11.0287 0.0728832 11.084 0.046796C11.1393 0.0207089 11.1995 0.00517753 11.2612 0.00108985C11.3229 -0.00299783 11.3848 0.00443838 11.4435 0.0229734ZM14.9225 1.64788C14.9663 1.60655 15.001 1.5575 15.0246 1.5035C15.0483 1.44951 15.0605 1.39165 15.0605 1.33321C15.0605 1.27477 15.0483 1.2169 15.0246 1.16291C15.001 1.10892 14.9663 1.05986 14.9225 1.01854C14.8788 0.977214 14.8268 0.944435 14.7697 0.922072C14.7125 0.899708 14.6512 0.888197 14.5894 0.888197C14.5275 0.888197 14.4662 0.899708 14.4091 0.922072C14.3519 0.944435 14.3 0.977214 14.2562 1.01854L12.3742 2.79633C12.3304 2.83759 12.2957 2.88659 12.272 2.94053C12.2483 2.99447 12.2361 3.05229 12.236 3.11069C12.236 3.22863 12.2855 3.34177 12.3737 3.42522C12.4619 3.50868 12.5816 3.55561 12.7065 3.5557C12.8313 3.55578 12.9511 3.50901 13.0395 3.42567L14.9216 1.64788H14.9225ZM5.2787 1.90655C5.41007 1.64548 5.60685 1.41861 5.85198 1.24559C6.09712 1.07257 6.38322 0.95862 6.6855 0.913615C6.98779 0.86861 7.29712 0.893906 7.58672 0.987311C7.87631 1.08072 8.13743 1.23941 8.34744 1.44965L14.5461 7.65415C14.7529 7.86116 14.9041 8.11207 14.987 8.38576C15.0698 8.65946 15.0819 8.94794 15.0221 9.22695C14.9623 9.50596 14.8325 9.76733 14.6436 9.98909C14.4546 10.2108 14.2121 10.3865 13.9363 10.5013L10.2314 12.0444C10.3687 12.5071 10.3909 12.9935 10.2961 13.4656C10.2014 13.9377 9.99224 14.3827 9.68513 14.7657C9.37802 15.1488 8.98125 15.4595 8.52585 15.6736C8.07046 15.8878 7.56879 15.9995 7.0601 16C6.49944 16.0003 5.94799 15.8653 5.45805 15.6078C4.9681 15.3504 4.55589 14.979 4.26049 14.5289L3.13124 14.9982C2.87182 15.1063 2.58397 15.138 2.30518 15.0893C2.02638 15.0407 1.76956 14.9138 1.56817 14.7253L0.418217 13.6489C0.210282 13.4543 0.0715068 13.2035 0.0210972 12.9312C-0.0293125 12.6589 0.011136 12.3785 0.136845 12.1289L5.2787 1.90743V1.90655ZM5.13378 14.1644C5.44611 14.5856 5.9034 14.8914 6.4277 15.0298C6.95201 15.1681 7.51088 15.1304 8.00907 14.9231C8.50726 14.7158 8.91392 14.3518 9.15975 13.893C9.40557 13.4342 9.47535 12.909 9.35718 12.4071L5.13378 14.1644ZM14.1179 4.44434C13.9931 4.44434 13.8734 4.49117 13.7852 4.57452C13.697 4.65787 13.6474 4.77092 13.6474 4.88879C13.6474 5.00667 13.697 5.11972 13.7852 5.20307C13.8734 5.28642 13.9931 5.33324 14.1179 5.33324H15.5295C15.6543 5.33324 15.7739 5.28642 15.8622 5.20307C15.9504 5.11972 16 5.00667 16 4.88879C16 4.77092 15.9504 4.65787 15.8622 4.57452C15.7739 4.49117 15.6543 4.44434 15.5295 4.44434H14.1179Z"
                                    fill="#24354D" />
                            </svg>
                            <span>convocations</span>
                        </div>
                    </a>
                    <span class="split-bar"></span>
                </li>

                <!-- CLUB -->

                <li class="dropdown-menu">
                    <a href="#">
                        <div class="dropdown-link">
                            <div class="bloc-icon">
                                <svg width="16" height="12" viewBox="0 0 16 12" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7 11.995C7 11.995 6 11.995 6 10.9954C6 9.99585 7 6.9971 11 6.9971C15 6.9971 16 9.99585 16 10.9954C16 11.995 15 11.995 15 11.995H7ZM11 5.99751C11.7956 5.99751 12.5587 5.68157 13.1213 5.1192C13.6839 4.55682 14 3.79408 14 2.99876C14 2.20344 13.6839 1.44069 13.1213 0.878315C12.5587 0.31594 11.7956 0 11 0C10.2043 0 9.44129 0.31594 8.87868 0.878315C8.31607 1.44069 8 2.20344 8 2.99876C8 3.79408 8.31607 4.55682 8.87868 5.1192C9.44129 5.68157 10.2043 5.99751 11 5.99751Z"
                                        fill="#24354D" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M5.216 11.995C5.06775 11.6829 4.99382 11.3408 5 10.9954C5 9.64092 5.68 8.24648 6.936 7.27687C6.30909 7.08379 5.65595 6.98936 5 6.99699C1 6.99699 0 9.99578 0 10.9954C0 11.995 1 11.995 1 11.995H5.216Z"
                                        fill="#24354D" />
                                    <path
                                        d="M4.5 5.99749C5.16304 5.99749 5.79893 5.7342 6.26777 5.26556C6.73661 4.79692 7 4.1613 7 3.49854C7 2.83578 6.73661 2.20016 6.26777 1.73152C5.79893 1.26288 5.16304 0.999598 4.5 0.999598C3.83696 0.999598 3.20107 1.26288 2.73223 1.73152C2.26339 2.20016 2 2.83578 2 3.49854C2 4.1613 2.26339 4.79692 2.73223 5.26556C3.20107 5.7342 3.83696 5.99749 4.5 5.99749Z"
                                        fill="#24354D" />
                                </svg>
                                <span>club</span>
                            </div>
                            <img src="../img/dropdown-icon.png" alt="menu déroulant">
                        </div>
                    </a>
                    <ul>
                        <li><a href="#">Histoire</a></li>
                        <li><a href="#">Palmarès</a></li>
                        <li><a href="#">Organigramme</a></li>
                    </ul>
                    <span class="split-bar"></span>
                </li>

                <!-- GALERIE -->

                <li class="dropdown-menu">
                    <a href="#">
                        <div class="dropdown-link">
                            <div class="bloc-icon">
                                <svg width="16" height="18" viewBox="0 0 16 18" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7.13244 8.47645L6.22222 7.11111L4.44444 9.77778H12.4444L9.33333 5.33333L7.13244 8.47645Z"
                                        fill="#24354D" />
                                    <path
                                        d="M5.78045 6.22222C6.5183 6.22222 7.11645 5.62407 7.11645 4.88622C7.11645 4.14837 6.5183 3.55022 5.78045 3.55022C5.04259 3.55022 4.44444 4.14837 4.44444 4.88622C4.44444 5.62407 5.04259 6.22222 5.78045 6.22222Z"
                                        fill="#24354D" />
                                    <path
                                        d="M14.2222 0H2.66667C1.59467 0 0 0.710222 0 2.66667V15.1111C0 17.0676 1.59467 17.7778 2.66667 17.7778H16V16H2.67733C2.26667 15.9893 1.77778 15.8276 1.77778 15.1111C1.77778 14.3947 2.26667 14.2329 2.67733 14.2222H16V1.77778C16 0.797333 15.2027 0 14.2222 0ZM14.2222 12.4444H1.77778V2.66667C1.77778 1.95022 2.26667 1.78844 2.66667 1.77778H14.2222V12.4444Z"
                                        fill="#24354D" />
                                </svg>
                                <span>galerie</span>
                            </div>
                            <img src="../img/dropdown-icon.png" alt="menu déroulant">
                        </div>
                    </a>
                    <ul>
                        <li><a href="galerie.html">photos</a></li>
                        <li><a href="galerie.html">vidéos</a></li>
                    </ul>
                    <span class="split-bar"></span>
                </li>

                <!-- PARTENAIRES -->

                <li>
                    <a href="#">
                        <div class="bloc-icon">
                            <svg width="16" height="12" viewBox="0 0 16 12" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M1 6.4867C0.782994 6.4865 0.571817 6.5538 0.398405 6.67844C0.224994 6.80308 0.0987801 6.97827 0.0388505 7.17753C-0.0210791 7.37679 -0.0114649 7.58927 0.0662392 7.78284C0.143943 7.97641 0.285511 8.14055 0.469534 8.25043L3.15484 10.8158C3.24766 10.9045 3.35784 10.9747 3.47908 11.0227C3.60033 11.0706 3.73027 11.0952 3.86149 11.0952C3.9927 11.0952 4.12263 11.0704 4.24384 11.0224C4.36505 10.9744 4.47517 10.904 4.56792 10.8154C4.66068 10.7267 4.73424 10.6214 4.78441 10.5056C4.83458 10.3898 4.86038 10.2656 4.86033 10.1403C4.86029 10.0149 4.8344 9.89079 4.78414 9.77499C4.73388 9.65919 4.66024 9.55398 4.56743 9.46537L3.44755 8.39645H10.99C11.2549 8.39645 11.509 8.2959 11.6964 8.11691C11.8837 7.93793 11.989 7.69517 11.989 7.44205C11.989 7.18893 11.8837 6.94618 11.6964 6.76719C11.509 6.58821 11.2549 6.48766 10.99 6.48766H1V6.4867Z"
                                    fill="#24354D" />
                                <path
                                    d="M15 4.60849C15.217 4.6087 15.4282 4.5414 15.6016 4.41676C15.775 4.29212 15.9012 4.11692 15.9612 3.91767C16.0211 3.71841 16.0115 3.50593 15.9338 3.31236C15.8561 3.11879 15.7145 2.95465 15.5305 2.84477L12.8452 0.279354C12.6577 0.100397 12.4035 -8.94323e-05 12.1385 5.97239e-08C11.8735 8.95517e-05 11.6194 0.100748 11.4321 0.279832C11.2448 0.458915 11.1396 0.701754 11.1397 0.954927C11.1398 1.2081 11.2451 1.45087 11.4326 1.62982L12.5525 2.69875H5.01002C4.74506 2.69875 4.49096 2.7993 4.30362 2.97828C4.11627 3.15727 4.01102 3.40002 4.01102 3.65314C4.01102 3.90627 4.11627 4.14902 4.30362 4.328C4.49096 4.50699 4.74506 4.60754 5.01002 4.60754H15V4.60849Z"
                                    fill="#24354D" />
                            </svg>
                            <span>partenaires</span>
                        </div>
                    </a>
                </li>
            </ul>
        </nav>
    </header>

    <!-- MAIN -->

    <main class="main-article-full">
        <section class="container">
            <h2 class="sec-title title-page">Actualités</h2>

            <!-- ARTICLE CONTAINER -->

            <article class="article-container">
                <div class="article-full-img">
                    <img class="img-cover" src="../img/img-test-foot.jpg" alt="Image d'article">
                </div>
                <div class="article-content">
                    <div class="article-entete">
                        <h3>Résumé de l'article</h3>
                        <p>Date article / Auteur</p>
                    </div>
                    <div class="article-text">
                        <p>
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. In consequuntur ab perferendis
                            necessitatibus itaque nam aut similique enim esse nobis. Illum, minima fugiat reiciendis
                            commodi alias omnis non eum ipsum. Nemo doloremque rerum sequi officiis ullam neque eligendi
                            earum, quia dicta officia ut molestiae possimus, voluptatum praesentium dignissimos dolores
                            culpa expedita itaque nisi. Quos, est eligendi sunt quae assumenda esse voluptatum, cum
                            suscipit hic ut mollitia pariatur inventore nostrum fugiat, vero ipsum temporibus. Nam
                            dolorum, mollitia provident, culpa, id maiores quas reprehenderit nostrum earum labore ut
                            reiciendis corrupti voluptatem sed iusto quis expedita necessitatibus in. Animi repellendus
                            dolores illum numquam, totam excepturi similique molestiae labore iusto voluptatibus veniam
                            laborum, est necessitatibus dolorem aliquam natus. Deserunt sapiente sit pariatur adipisci
                            modi ipsum deleniti excepturi explicabo natus magni consectetur perspiciatis velit amet
                            facilis vero laboriosam, obcaecati suscipit nam quisquam provident totam id eos ipsa? Quos
                            at inventore maxime voluptas culpa minima delectus sequi optio, officia, fugiat animi
                            reprehenderit quod. Ipsa vel, deleniti magnam aperiam placeat mollitia accusamus repellendus
                            nam pariatur doloribus tempore ad labore eveniet commodi cumque, error inventore aut minus
                            in! Libero quo amet illo molestiae? Quaerat tempore aliquid explicabo, voluptate nostrum
                            obcaecati vitae porro sit minima amet magni quisquam similique.
                        </p>
                    </div>
                </div>
            </article>
        </section>
    </main>

    <!-- FOOTER -->

    <footer>
        <div class="footer-container">
            <div class="footer-top">
                <div class="logo-team-s">
                    <img class="img-contain" src="../img/logo-ems.png" alt="logo : football club eure madrie seine">
                </div>
                <h3>Football club eure madrie seine</h3>
            </div>
            <nav class="footer-nav">
                <ul>
                    <li><a href="home.html">Accueil</a></li>
                    <li><a href="actualite.html">Actualité</a></li>
                    <li><a href="resultats.html">Résultats</a></li>
                    <li><a href="convocation.html">Convocations</a></li>
                </ul>
                <ul>
                    <li><a href="histoire.html">Histoire</a></li>
                    <li><a href="palmares.html">Palmarès</a></li>
                    <li><a href="galerie.html">Galerie</a></li>
                    <li><a href="organigramme.html">Organigramme</a></li>
                </ul>
                <ul>
                    <li><a href="partenaire.html">Partenaires</a></li>
                    <li><a href="#">Boutique</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="#">Se connecter</a></li>
                </ul>
                <ul>
                    <li>
                        <a href="#">
                            <div class="icon-s">
                                <img class="img-contain" src="../img/accueil.svg" title="instagram"
                                    alt="lien vers l'instagram du club">
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="icon-s">
                                <img class="img-contain" src="../img/accueil.svg" title="facebook"
                                    alt="lien vers le facebook du club">
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="icon-s">
                                <img class="img-contain" src="../img/accueil.svg" title="email"
                                    alt="lien vers le mail du club">
                            </div>
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="footer-legal">
                <span>@ 2022 EMS</span>
                <a href="#">mentions légales</a>
            </div>
        </div>
    </footer>

    <!-- JS -->

    <script src="../js/app.js"></script>
</body>

</html>