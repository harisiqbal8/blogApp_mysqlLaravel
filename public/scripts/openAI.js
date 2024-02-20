function generateText() {
    let promptTitle = document.getElementById("title").value;
    document.getElementById("body").innerHTML = "Loading...";
    document.getElementById("generateButton").style.display = "none";
    document.getElementById("promptLoader").style.display = "block";
    axios
        .post("/api/content", {
            prompt: promptTitle,
        })
        .then(function (response) {
            let gptResponse = response.data.choices[0].message.content;
            document.getElementById("body").innerHTML = gptResponse;
            document.getElementById("generateButton").style.display = "block";
            document.getElementById("promptLoader").style.display = "none";
        
        })
        .catch(function (error) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Something went wrong!"

            });
            document.getElementById("body").innerHTML = "Something Went Wrong, Please try again...";
            document.getElementById("generateButton").style.display = "block";
            document.getElementById("promptLoader").style.display = "none";

        });
}
function showButton() {
    document.getElementById("generateButton").style.display = "block";
}
function hideButton() {
    if (
        document.getElementById("title").value === undefined ||
        document.getElementById("title").value === ""
    ) {
        document.getElementById("generateButton").style.display = "none";
    }
}

// tinymce.init({
//     selector: 'textarea#body'
// });