function changeView() {
    var signInBox = document.getElementById("signInBox");
    var signUpBox = document.getElementById("signUpBox");

    signInBox.classList.toggle("d-none");
    signUpBox.classList.toggle("d-none");
}

function signUp() {
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var email = document.getElementById("email");
    var mobile = document.getElementById("mobile");
    var username = document.getElementById("username");
    var password = document.getElementById("password");

    var f = new FormData();
    f.append("f", fname.value);
    f.append("l", lname.value);
    f.append("e", email.value);
    f.append("m", mobile.value);
    f.append("u", username.value);
    f.append("p", password.value);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;

            if (response == "Success") {
                document.getElementById("msg1").innerHTML = "Successfully Registered! Sign In to Continue";
                document.getElementById("msg1").className = "alert alert-success";
                document.getElementById("msgDiv1").className = "col-10 mx-auto mt-3";

                fname.value = "";
                lname.value = "";
                email.value = "";
                mobile.value = "";
                username.value = "";
                password.value = "";
            } else {
                document.getElementById("msg1").innerHTML = response;
                document.getElementById("msgDiv1").className = "d-block";
            }

        }
    };

    request.open("POST", "signUpProcess.php", true);
    request.send(f);

}

function showPasswordSignUp() {

    var sp = document.getElementById("password");
    var spb = document.getElementById("spbsu");

    if (sp.type == "password") {
        sp.type = "text";
        spb.className = "col-1 bg-danger text-white border border-secondary mt-4 rounded-3";
        spb.innerHTML = '<i class="bi bi-eye-slash-fill"></i>';
    } else {
        sp.type = "password";
        spb.className = "col-1 bg-success text-white border border-secondary mt-4 rounded-3";
        spb.innerHTML = '<i class="bi bi-eye-fill"></i>';
    }

}

function signIn() {
    var un = document.getElementById("un");
    var pw = document.getElementById("pw");
    var rm = document.getElementById("flexSwitchCheckChecked rm");

    var f = new FormData();
    f.append("u", un.value);
    f.append("p", pw.value);
    f.append("r", rm.checked);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            if (response == "Success") {
                window.location = "home.php";
            } else {
                document.getElementById("msg2").innerHTML = response;
                document.getElementById("msgDiv2").className = "d-block";
            }
        }
    };

    request.open("POST", "signInProcess.php", true);
    request.send(f);


}

function showPasswordSignIn() {

    var sp = document.getElementById("pw");
    var spb = document.getElementById("spbsi");

    if (sp.type == "password") {
        sp.type = "text";
        spb.className = "col-1 bg-danger text-white border border-secondary mt-4 rounded-3";
        spb.innerHTML = '<i class="bi bi-eye-slash-fill"></i>';
    } else {
        sp.type = "password";
        spb.className = "col-1 bg-success text-white border border-secondary mt-4 rounded-3";
        spb.innerHTML = '<i class="bi bi-eye-fill"></i>';
    }

}

function forgetPassword() {
    var email = document.getElementById("e");

    if (email.value != "") {

        var f = new FormData();
        f.append("e", email.value);

        var request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var response = request.responseText;
                if (response == "Success") {
                    document.getElementById("forgetMsg").innerHTML = "Successfully sent! Check your email";
                    document.getElementById("forgetMsg").className = "alert alert-success";
                    document.getElementById("forgetMsgDiv").className = "d-block";
                } else {
                    document.getElementById("forgetMsg").innerHTML = response;
                    document.getElementById("forgetMsg").className = "alert alert-danger";
                    document.getElementById("forgetMsgDiv").className = "d-block";
                }
            }
        };

        request.open("POST", "forgetPasswordProcess.php", true);
        request.send(f);

    } else {
        document.getElementById("forgetMsg").innerHTML = "Please enter your Email";
        document.getElementById("forgetMsg").className = "alert alert-danger";
        document.getElementById("forgetMsgDiv").className = "d-block";
    }
}

function resetPassword() {
    var vcode = document.getElementById("vcode");
    var np = document.getElementById("np");
    var np2 = document.getElementById("np2");

    var f = new FormData();
    f.append("vcode", vcode.value);
    f.append("np", np.value);
    f.append("np2", np2.value);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            if (response == "Success") {
                window.location = "signin.php";
            } else {
                document.getElementById("resetMsg").innerHTML = response;
                document.getElementById("resetMsg").className = "alert alert-danger";
                document.getElementById("resetMsgDiv").className = "d-block";
            }
        }

    };

    request.open("POST", "resetPasswordProcess.php", true);
    request.send(f);
}

function showPasswordReset1() {

    var sp = document.getElementById("np");
    var spb = document.getElementById("spbr1");

    if (sp.type == "password") {
        sp.type = "text";
        spb.className = "col-1 bg-danger text-white border border-secondary mt-4 rounded-3";
        spb.innerHTML = '<i class="bi bi-eye-slash-fill"></i>';
    } else {
        sp.type = "password";
        spb.className = "col-1 bg-success text-white border border-secondary mt-4 rounded-3";
        spb.innerHTML = '<i class="bi bi-eye-fill"></i>';
    }

}

function showPasswordReset2() {

    var sp = document.getElementById("np2");
    var spb = document.getElementById("spbr2");

    if (sp.type == "password") {
        sp.type = "text";
        spb.className = "col-1 bg-danger text-white border border-secondary mt-4 rounded-3";
        spb.innerHTML = '<i class="bi bi-eye-slash-fill"></i>';
    } else {
        sp.type = "password";
        spb.className = "col-1 bg-success text-white border border-secondary mt-4 rounded-3";
        spb.innerHTML = '<i class="bi bi-eye-fill"></i>';
    }

}

function signOut() {
    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            alert(response);
            // window.location.reload();
            window.location = "signin.php";
        }
    };
    request.open("GET", "signOutProcess.php", true);
    request.send();
}

function loadProduct(x) {

    var page = x;

    var f = new FormData();
    f.append("p", page);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 & request.status == 200) {
            var response = request.responseText;
            document.getElementById("pid").innerHTML = response;

        }
    };


    request.open("POST", "loadProductProcess.php", true);
    request.send(f);

}

function searchProduct(x) {


    var page = x;

    var product = document.getElementById("product");

    // alert(page);
    // alert(product.value);

    var f = new FormData();
    f.append("p", product.value);
    f.append("pg", page);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 & request.status == 200) {
            var response = request.responseText;
            // alert(response);
            document.getElementById("pid").innerHTML = response;
        }
    };
    request.open("POST", "searchProductProcess.php", true);
    request.send(f);
}


function viewFilter() {

    var filterBlock = document.getElementById("filterId");
    var carousel = document.getElementById("carouselExampleIndicators");
    var basicSearchBox = document.getElementById("bsb");

    if (filterBlock.className == "d-none") {
        filterBlock.className = "d-block";
        carousel.className = "d-none";
        basicSearchBox.className = "d-none";
    } else {
        filterBlock.className = "d-none";
        carousel.className = "col-9 mx-auto shadow-sm carousel carousel-dark slide mt-3 mb-3";
        basicSearchBox.className = "container d-flex justify-content-center mt-3";
    }
}

function advSearchProduct(x) {

    var page = x;
    var searchText = document.getElementById("text");
    var category = document.getElementById("category");
    var brand = document.getElementById("brand");
    var availability = document.getElementById("availability");
    var sort = document.getElementById("sort");
    var min = document.getElementById("min");
    var max = document.getElementById("max");

    var f = new FormData();
    f.append("pg", page);
    f.append("text", searchText.value);
    f.append("cat", category.value);
    f.append("b", brand.value);
    f.append("avb", availability.value);
    f.append("sort", sort.value);
    f.append("min", min.value);
    f.append("max", max.value);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 & request.status == 200) {
            var response = request.responseText;
            // alert(response);
            document.getElementById("pid").innerHTML = response;

        }
    };
    request.open("POST", "advanceSearchProductProcess.php", true);
    request.send(f);

}


function adminSignIn() {

    var un = document.getElementById("un");
    var pw = document.getElementById("pw");

    var f = new FormData();
    f.append("u", un.value);
    f.append("p", pw.value);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            if (response == "Success") {
                window.location = "adminDashboard.php";
            } else {
                document.getElementById("msg").innerHTML = response;
                document.getElementById("msgDiv").className = "d-block";
            }
        }
    };

    request.open("POST", "adminSignInProcess.php", true);
    request.send(f);

}
