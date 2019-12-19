const url = 'submit.php'
$("#submit-button").click(() => {
    const files = $("#file")[0].files
    const formData = new FormData()
    for (let i = 0; i < files.length; i++) {
        let file = files[i]
        formData.append('files[]', file)
    }
    fetch(url, {
        method: 'POST',
        body: formData,
        headers: {
            title: encodeURI($("#title").val()),
            introduction: encodeURI($("#introduction").val()),
            instructions: encodeURI($("#instructions").val()),
            skills: encodeURI($("#skills").val()),
        }
    }).then(response => response.text()).then(text => {
        if (text == "-1"){
            $("#message").text("Failed to upload activity!");
            $("#message").css("color", "red");
        } else if (text == "1"){
            $("#message").text("Activity uploaded!");
            $("#message").css("color", "green");
        }
    })
})
