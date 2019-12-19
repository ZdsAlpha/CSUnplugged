
class Controller {
    constructor (){
        this.command_php = "command.php";

    };
    register(username, fn, ln, pass) {
        $.ajax({
            url : this.command_php + "?command=register&username=" + encodeURI(username) + "&fn=" + encodeURI(fn) + "&ln=" + encodeURI(ln) + "&password" + encodeURI(pass) 
        }).done((result) => {
            
        });
    };
};
$(document).ready(function(){
    window.controller = new Controller();
});