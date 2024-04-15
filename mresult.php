<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mental Health Quiz Result</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="chat.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Plus Jakarta Sans", sans-serif;
        }

        .header {
            min-height: 70vh;
        }

        .header,
        .cta,
        .sub-header {
            background-image: url('imgs/tempbg.png');
            background-position: center;
            background-size: cover;
        }

        .sub-header,
        .light-mode .sub-header {
            background-image: linear-gradient(rgba(255, 255, 255, 0.7), rgba(255, 255, 255, 0.7)),
                url('imgs/tempbg.png');
        }

        .dark-mode .sub-header {
            background-image: linear-gradient(rgba(4, 9, 30, 0.7), rgba(4, 9, 30, 0.7)),
                url('imgs/tempbg.png');
        }

        .result {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 2px solid #ad8a38;
            border-radius: 10px;
            background-color: #fff;
            margin-top: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .result h2 {
            margin-bottom: 10px;
            color: #ad8a38;
            text-align: center;
        }

        .result p {
            margin-bottom: 15px;
            line-height: 1.6;
        }

        .article-card {
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid #ad8a38;
            border-radius: 10px;
            background-color: #f9f9f9;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .article-card h3 {
            margin-bottom: 10px;
            color: #333;
        }

        .article-card p {
            margin-bottom: 5px;
            line-height: 1.6;
        }

        .article-card a {
            color: #ad8a38;
            text-decoration: none;
            font-weight: bold;
        }

        .article-card a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <section class="header">
        <nav style="padding-top: 30px;">
            <img style="width: 250px; margin-left: 85px;" src="imgs/nvt1.png">
            <a href="index.html"></a>
            <div class="nav-links" id="navLinks">
                <i class="fa fa-times" onclick="hidemenu()"></i>
                <ul>
                    <li><a href="home2.html" style="font-size: 18px;">Home</a></li>
                    <li><a href="career.html" style="font-size: 18px;">Career</a></li>
                    <li><a href="mquiz.html" style="font-size: 18px;">Mental Health</a></li>
                    <li><a href="explore.html" style="font-size: 18px;">Explore</a></li>
                    <li><a href="ideahub.html" style="font-size: 18px;">IdeaHub</a></li>
                    <li><a href="community.html" style="font-size: 18px;">Community</a></li>
                    <li><a href="article.html"
                            style="font-size: 18px;">Articles</a></li>
                    <li><a href="profile.html"
                            style="font-size: 18px;background-color: #ad8a38; font-weight: bold; padding: 10px; border-radius: 5px;">Profile</a>
                    </li>

                </ul>
            </div>
            <i class="fa fa-bars" onclick="showMenu()"></i>
        </nav>

        <br><br><br><br>
        <div class="text-box">
            <h1 style="padding-top: 20px; font-size: 70px;">Your quiz result</h1>
        </div>

        <button class="chatbot-toggler">
            <span class="material-symbols-rounded"><i class="fa-solid fa-message"></i></span>
            <span class="material-symbols-outlined"><i class="fa-solid fa-xmark"></i></span>
        </button>
        <div class="chatbot">
            <header>
                <h2>Chatbot</h2>
                <span class="close-btn material-symbols-outlined"><i class="fa-solid fa-xmark"></i></span>
            </header>
            <ul class="chatbox">
                <li class="chat incoming">
                    <span class="material-symbols-outlined"><i class="fa-regular fa-paper-plane"></i></span>
                    <p>Hi there 👋<br>How can I help you today?</p>
                </li>
            </ul>
            <div class="chat-input">
                <textarea placeholder="Enter a message..." spellcheck="false" required></textarea>
                <span id="send-btn" class="material-symbols-rounded"><i class="fa-solid fa-share"></i></span>
            </div>
        </div>
    </section>
    <div class="result">
        <h2>Quiz Result</h2>
        <p>Please remember that these results should be taken with a grain of salt and are not a substitute for
            professional advice.</p>
            <?php
                // Fetching user responses from the form
                $mood = $_POST['mood'];
                $physical_wellness = $_POST['physical_wellness'];
                $sleep_quality = $_POST['sleep_quality'];
                $task_management = $_POST['task_management'];
                $support_network = $_POST['support_network'];
                $concentration_issues = $_POST['concentration_issues'];
                $relationship_satisfaction = $_POST['relationship_satisfaction'];
                $appetite_changes = $_POST['appetite_changes'];
                $joyful_activities = $_POST['joyful_activities'];
                $emotional_overwhelm = $_POST['emotional_overwhelm'];

                // Initialize an array to store suggested articles
                $suggested_articles = array();

                // Initialize an array to store corresponding links for each article
                $article_links = array();

                // Determine suggested articles based on user responses
                if ($mood === 'good') {
                    $suggested_articles[] = "Tips for Maintaining a Positive Outlook";
                    $article_links[] = "https://www.nytimes.com/2017/03/27/well/live/positive-thinking-may-improve-health-and-extend-life.html";
                    $suggested_articles[] = "10 Habits of Happy People";
                    $article_links[] = "https://www.forbes.com/sites/travisbradberry/2017/02/14/ten-habits-of-incredibly-happy-people/";
                }

                if ($emotional_overwhelm === 'often' || $mood === 'anxious' || $mood === 'depressed') {
                    $suggested_articles[] = "Managing Anxiety: Techniques and Strategies";
                    $article_links[] = "https://adaa.org/tips";
                    $suggested_articles[] = "Understanding Depression and Seeking Help";
                    $article_links[] = "https://www.nhs.uk/mental-health/conditions/depression-in-adults/overview/";
                }

                if ($physical_wellness === 'no' || $sleep_quality === 'disturbed' || $task_management === 'overwhelming' || $support_network === 'distant' || $concentration_issues === 'yes' || $relationship_satisfaction === 'unsatisfied' || $appetite_changes === 'yes') {
                    $suggested_articles[] = "Recognizing Signs of Abuse and Seeking Support";
                    $article_links[] = "https://www.webmd.com/mental-health/mental-domestic-abuse-signs";
                    $suggested_articles[] = "Recovery from Abuse: Stories of Survival";
                    $article_links[] = "https://www.rainn.org/STORIES";
                    $suggested_articles[] = "Helpline Numbers for Victims of Abuse";
                    $article_links[] = "https://asiapacific.unwomen.org/en/focus-areas/end-violence-against-women/shadow-pandemic-evaw-and-covid-response/list-of-helplines";
                }

                // Output the suggested articles
                if (!empty($suggested_articles)) {
                    echo "<h3>Suggested Articles:</h3>";
                    foreach ($suggested_articles as $key => $article) {
                        echo "<div class='article-card'>";
                        echo "<h3>$article</h3>";
                        echo "<p>Find more information <a href='$article_links[$key]'>here</a>.</p>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>No specific articles to suggest based on your responses. If you need further assistance, consider
                                reaching out to a mental health professional.</p>";
                }
            ?>
    </div>
    <br>
    <section class="footer">
        <h3 style="color:#f0dbaa; font-weight: bold;">Contact Us</h3>
        <div class="icons">
            <i class="fab fa-facebook"></i>
            <i class="fab fa-twitter"></i>
            <i class="fab fa-instagram"></i>
            <i class="fab fa-linkedin"></i>
        </div>
    </section>

    <script src="cscript.js"></script>

    <script>
        var navlinks = document.getElementById("navLinks");

        function showMenu() {
            navlinks.style.right = "0";
        }

        function hidemenu() {
            navlinks.style.right = "-200px";
        }

        function toggleMode() {
            document.body.classList.toggle('dark-mode');
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const currentUser = getCurrentUser();

            if (currentUser) {
                if (currentUser.role === 'admin') {
                    document.getElementById('reviews').contentEditable = true;
                } else {
                    document.getElementById('reviews').contentEditable = false;
                }
            }
        });
    </script>

    <script src="chello.js"></script>

    <script src="https://translate.google.com/translate_a/element.js?cb=loadGoogleTranslate"></script>
    <script>
        function loadGoogleTranslate() {
            new google.translate.TranslateElement({
                pageLanguage: 'en'
            }, 'google_translate_element');
        }
    </script>
</body>

</html>
