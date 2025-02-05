document.getElementById("imageUpload").addEventListener("change", function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function() {
            document.getElementById("profileImage").src = reader.result;
        }
        reader.readAsDataURL(file);
    }
});
