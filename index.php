<!DOCTYPE html>
<html lang="en">

<head>
    <title>CS Unplugged</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <script type="text/javascript" src="data.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Favicon icon -->
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
    <!-- fontawesome icon -->
    <link rel="stylesheet" href="assets/fonts/fontawesome/css/fontawesome-all.min.css">
    <!-- animation css -->
    <link rel="stylesheet" href="assets/plugins/animation/css/animate.min.css">
    <!-- vendor css -->
    <link rel="stylesheet" href="assets/css/style.css">

    <script>
        function getRandomInt(min, max) {
            min = Math.ceil(min);
            max = Math.floor(max);
            return Math.floor(Math.random() * (max - min + 1)) + min;
        }
        class Controller {
            constructor (){
                this.target = "list"
                this.template = "template"
                this.factory = new ActivityFactory("template");
                this.visitor = new ActivityVisitor();
            }
            refreshActivities() {
                fetch("activities.php").then(response => response.json()).then(json => {
                    json.forEach(activity => {
                        activity = new ActivityObject(activity["title"], activity["intro"], "activity.php?id=" + activity["id"]);
                        this.visitor.visit(activity);
                    });
                });
            }
            createActivity(title, description, link) {
                var activity = this.factory.createActivity(title, description, link);
                activity.appendTo("#" + this.target);
                return activity;
            }
            deleteActivity(title) {
                document.getElementById(this.target).childNodes.forEach((child) => {
                    if ($(child).find(".t-title").text() == title){
                        child.parentNode.removeChild(child);
                    }
                })
            }
            loadActivities(callback){
                callback(callback(window.data))
            }
        }
        class ActivityFactory {
            constructor (activity_template_name){
                this.template = activity_template_name;
            }
            createActivity(title, description, link){
                var activity = $("#" + this.template).clone();
                var id = activity.attr("id") + getRandomInt(0, 1000000);
                var collapse_id = getRandomInt(0, 1000000);
                activity.find("#collapse").attr("id", "collapse" + collapse_id);
                activity.find(".t-title").attr("data-target", "#collapse" + collapse_id);
                activity.attr("id", id);
                activity.find(".t-title").text(title);
                activity.find(".t-description").text(description);
                activity.find(".t-button").click(() => window.open(link));
                activity.find(".d-button").click(() => window.controller.deleteActivity(title));
                activity.css("display", "block");
                return activity;
            }
        }
        class ActivityObject{
            constructor (title, description, link){
                this.title = title;
                this.desc = description;
                this.link = link;
            }
            accept(visitor){
                visitor.visit(this);
            }
        }
        class ActivityVisitor{
            constructor (){}
            visit(activity){
                controller.createActivity(activity.title, activity.desc, activity.link);
            }
        }
        $(document).ready(function(){
            window.controller = new Controller();
            window.controller.refreshActivities();
        });
    </script>
</head>

<body>
    <div class="auth-wrapper">
        <div class="auth-content" style="width: 1000px;">
            <div class="auth-bg">
                <span class="r"></span>
                <span class="r s"></span>
                <span class="r s"></span>
                <span class="r"></span>
            </div>
            <div class="card">
                <div class="card-body text-center">
                    <h3 class="mb-4">CS Unplugged Activities</h3>
                    <div id="list">
                        <div id="template" class="card" style="display: none;">
                            <div class="card-header" style="text-align: left;">
                                <h5 class="mb-0">
                                    <a class="t-title" href="#!" data-toggle="collapse" data-target="#collapse" aria-expanded="true"></a>
                                </h5>
                            </div>
                            <div id="collapse" class="card-body collapse" style="text-align: left;">
                                <p class="t-description">
                                </p>
                                <div style="width: 100%; display: flex; justify-content: space-between;">
                                    <button type="button" class="btn btn-primary d-button" style="background-color: red;">Delete</button>
                                    <button type="button" class="btn btn-primary t-button">View ></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br/>
                    <h3 class="mb-4">Actions</h3>
                    <button type="button" class="btn btn-primary t-button" style="width: 200px;" onclick="window.location.href='login.php'">Login</button>
                    <button type="button" class="btn btn-primary t-button" style="width: 200px;" onclick="window.location.href='register.php'">Register</button>
                    <button type="button" class="btn btn-primary t-button" style="width: 200px;" onclick="window.location.href='upload.php'">Submit Activity</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Required Js -->
    <script src="assets/js/vendor-all.min.js"></script>
	<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
