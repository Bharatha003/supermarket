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

    var password = document.getElementById("pw");
    var icon = document.getElementById("spbsi");

    if (password.type == "password") {
        password.type = "text";
        icon.className = "col-1 bg-danger text-white border border-secondary mt-4 rounded-3";
        icon.innerHTML = '<i class="bi bi-eye-slash-fill"></i>';
    } else {
        password.type = "password";
        icon.className = "col-1 bg-success text-white border border-secondary mt-4 rounded-3";
        icon.innerHTML = '<i class="bi bi-eye-fill"></i>';
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
            window.location = "signin.php";
        }
    };
    request.open("GET", "signOutProcess.php", true);
    request.send();

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

function clearFilter() {

    var searchText = document.getElementById("text");
    var category = document.getElementById("category");
    var brand = document.getElementById("brand");
    var availability = document.getElementById("availability");
    var sort = document.getElementById("sort");
    var min = document.getElementById("min");
    var max = document.getElementById("max");
    var resultBox = document.getElementById("pid");

    searchText.value = "";
    category.value = "0";
    brand.value = "0";
    availability.value = "0";
    sort.value = "0";
    min.value = "";
    max.value = "";
    resultBox.innerHTML = "";

}

function loadCategory() {

    var category = document.getElementById("category");

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            category.innerHTML = response;
        }
    }

    request.open("GET", "loadCategory.php", true);
    request.send();

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
    var resultBox = document.getElementById("pid");

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
            resultBox.innerHTML = response;
        }
    };
    request.open("POST", "advanceSearchProductProcess.php", true);
    request.send(f);

}

function loadProduct(x) {

    var page = x;
    var resultBox = document.getElementById("pid");

    var f = new FormData();
    f.append("p", page);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 & request.status == 200) {
            var response = request.responseText;
            resultBox.innerHTML = response;

        }
    };

    request.open("POST", "loadProductProcess.php", true);
    request.send(f);

}

function searchProduct(x) {

    var page = x;
    var product = document.getElementById("product");
    var resultBox = document.getElementById("pid");
    var carousel = document.getElementById("carouselExampleIndicators");

    if (product.value != "") {
        carousel.className = "d-none";
    } else {
        carousel.className = "col-9 mx-auto shadow-sm carousel carousel-dark slide mt-3 mb-3";
        loadProduct(0);
    }

    var f = new FormData();
    f.append("p", product.value);
    f.append("pg", page);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 & request.status == 200) {
            var response = request.responseText;
            resultBox.innerHTML = response;
        }
    };

    request.open("POST", "searchProductProcess.php", true);
    request.send(f);

}

function uploadProfileImg() {

    var img = document.getElementById("imgUploader");

    var f = new FormData();
    f.append("pimg", img.files[0]);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 & request.status == 200) {
            var response = request.responseText;
            if (response == "empty") {
                alert("Please select Your Profile Image!");
            } else {
                document.getElementById("pimg").src = response;
                console.log(response);
                img.value = "";
            }
        }
    };
    request.open("POST", "profileImgUploadProcess.php", true);
    request.send(f);

}

function updateProfileData() {

    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var email = document.getElementById("email");
    var mobile = document.getElementById("mobile");
    var password = document.getElementById("password");
    var line1 = document.getElementById("line1");
    var line2 = document.getElementById("line2");

    var f = new FormData();
    f.append("f", fname.value);
    f.append("l", lname.value);
    f.append("e", email.value);
    f.append("m", mobile.value);
    f.append("p", password.value);
    f.append("l1", line1.value);
    f.append("l2", line2.value);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 & request.status == 200) {
            var response = request.responseText;
            alert(response);
            location.reload();
        }
    };

    request.open("POST", "profileDataUpdateProcess.php", true);
    request.send(f);

}

function showPasswordProfile() {

    var password = document.getElementById("password");
    var icon = document.getElementById("spbp");

    if (password.type == "password") {
        password.type = "text";
        icon.className = "bg-danger text-white border border-secondary mt-4 rounded-3 px-2 py-1";
        icon.innerHTML = '<i class="bi bi-eye-slash-fill"></i>';
    } else {
        password.type = "password";
        icon.className = "bg-success text-white border border-secondary mt-4 rounded-3 px-2 py-1";
        icon.innerHTML = '<i class="bi bi-eye-fill"></i>';
    }

}

function decreaseQty() {

    var input = document.getElementById("qty");

    if (input.value > 1) {
        var new_value = parseInt(input.value) - 1;
        input.value = new_value;
    } else {
        alert("You have reached to the Minimum Quantity!");
        input.value = 1;
    }

}

function increaseQty(qty) {

    var input = document.getElementById("qty");

    if (input.value < qty) {
        var new_value = parseInt(input.value) + 1;
        input.value = new_value;
    } else {
        alert("You have reached to the Maximum Quantity!");
        input.value = qty;
    }

}

function checkQtyInput(qty) {

    var input = document.getElementById("qty");

    if (input.value < 1 || input.value == "") {
        alert("You must add 1 or more!");
        input.value = 1;
    } else if (input.value > qty) {
        alert("Insufficiant quantity!");
        input.value = qty;
    }

}

function addToCart(stock_id) {

    var stockId = stock_id;
    var qty = document.getElementById("qty");

    if (qty.value > 0) {

        var f = new FormData();
        f.append("s", stockId);
        f.append("q", qty.value);

        var request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var response = request.responseText;
                alert(response);
                qty.value = "1";
            }
        };

        request.open("POST", "addToCartProcess.php", true);
        request.send(f);

    } else {
        alert("Please enter valid Qty!");
    }

}

function addToCartFromSearch(stock_id) {

    var stockId = stock_id;
    var qty = "1";

    var f = new FormData();
    f.append("s", stockId);
    f.append("q", qty);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            alert(response);
        }
    };

    request.open("POST", "addToCartProcess.php", true);
    request.send(f);

}

function loadCart() {

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 & request.status == 200) {
            var response = request.responseText;
            document.getElementById("cartBody").innerHTML = response;

        }
    };

    request.open("POST", "loadCartProcess.php", true);
    request.send();

}

function decreaseCartQty(x) {

    var cartId = x;
    var qty = document.getElementById("qty" + x);
    var newQty = parseInt(qty.value) - 1;

    var f = new FormData();
    f.append("c", cartId);
    f.append("q", newQty);

    if (newQty > 0) {

        var request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (request.readyState == 4 & request.status == 200) {
                var response = request.responseText;
                if (response == "Success") {
                    qty.value = parseInt(qty.value) - 1;
                    loadCart();
                } else {
                    alert(response);
                }
            }
        };

        request.open("POST", "updateCartQtyProcess.php", true);
        request.send(f);

    } else {
        alert("You have reached to the Minimum Quantity!");
    }

}

function increaseCartQty(x) {

    var cartId = x;
    var qty = document.getElementById("qty" + x);
    var newQty = parseInt(qty.value) + 1;

    var f = new FormData();
    f.append("c", cartId);
    f.append("q", newQty);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 & request.status == 200) {
            var response = request.responseText;
            if (response == "Success") {
                qty.value = parseInt(qty.value) + 1;
                loadCart();
            } else {
                alert(response);
            }
        }
    };

    request.open("POST", "updateCartQtyProcess.php", true);
    request.send(f);

}

function removeFromCart(cart_id) {

    var cartId = cart_id;

    if (confirm("Are you sure want Remove this Item?")) {

        var f = new FormData();
        f.append("c", cartId);

        var request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (request.readyState == 4 & request.status == 200) {
                var response = request.responseText;
                alert(response);
                location.reload();
            }
        };

        request.open("POST", "removeFromCartProcess.php", true);
        request.send(f);

    }

}

function checkOut() {

    var f = new FormData();
    f.append("cart", true);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;

            var payment = JSON.parse(response);
            doCheckout(payment, "checkoutProcess.php");
        }
    }

    request.open("POST", "paymentProcess.php", true);
    request.send(f);

}

function doCheckout(payment, path) {

    payhere.onCompleted = function onCompleted(orderId) {

        console.log("Payment completed. OrderID:" + orderId);

        var f = new FormData();
        f.append("payment", JSON.stringify(payment));

        var request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (request.readyState == 4 & request.status == 200) {
                var response = request.responseText;
                console.log(response);
                var order = JSON.parse(response);
                if (order.resp == "Success") {
                    console.log("Order completed with ID: " + order.order_id);
                    if (confirm("Do you want a Invoice?")) {
                        window.location = "invoice.php?orderId=" + order.order_id;
                    }
                } else {
                    alert(response);
                }
            }
        };

        request.open("POST", path, true);
        request.send(f);

    };

    payhere.onDismissed = function onDismissed() {
        console.log("Payment dismissed");
    };

    payhere.onError = function onError(error) {
        console.log("Error:" + error);
        alert("Error:" + error);
    };

    payhere.startPayment(payment);

}

function buyNow(stock_id) {

    var stockId = stock_id;
    var qty = document.getElementById("qty");

    if (qty.value > 0) {

        var f = new FormData();
        f.append("cart", false);
        f.append("stockId", stockId);
        f.append("qty", qty.value);

        var request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var response = request.responseText;

                var payment = JSON.parse(response);
                payment.stock_id = stockId;
                payment.qty = qty.value;
                doCheckout(payment, "buyNowProcess.php");
            }
        }

        request.open("POST", "paymentProcess.php", true);
        request.send(f);

    } else {
        alert("Please enter valid Quantity!");
    }

}

function buyNowFromSearch(stock_id) {

    var stockId = stock_id;
    var qty = "1";

    var f = new FormData();
    f.append("cart", false);
    f.append("stockId", stockId);
    f.append("qty", qty);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;

            var payment = JSON.parse(response);
            payment.stock_id = stockId;
            payment.qty = qty;
            doCheckout(payment, "buyNowProcess.php");
        }
    }

    request.open("POST", "paymentProcess.php", true);
    request.send(f);

}

function printDiv() {

    var originalContent = document.body.innerHTML;
    var printArea = document.getElementById("printArea").innerHTML;

    document.body.innerHTML = printArea;
    window.print();
    document.body.innerHTML = originalContent;

}

function adminSignIn() {

    var adminUn = document.getElementById("adminUn");
    var adminPw = document.getElementById("adminPw");
    var messageText = document.getElementById("msg3");
    var messageDiv = document.getElementById("msgDiv3");

    var f = new FormData();
    f.append("au", adminUn.value);
    f.append("ap", adminPw.value);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            if (response == "Success") {
                window.location = "adminDashboard.php";
            } else {
                messageText.innerHTML = response;
                messageDiv.className = "d-block";
            }
        }
    };

    request.open("POST", "adminSignInProcess.php", true);
    request.send(f);

}

function showPasswordAdminSignIn() {

    var password = document.getElementById("adminPw");
    var icon = document.getElementById("spbasi");

    if (password.type == "password") {
        password.type = "text";
        icon.className = "col-1 bg-danger text-white border border-secondary mt-4 rounded-3";
        icon.innerHTML = '<i class="bi bi-eye-slash-fill"></i>';
    } else {
        password.type = "password";
        icon.className = "col-1 bg-success text-white border border-secondary mt-4 rounded-3";
        icon.innerHTML = '<i class="bi bi-eye-fill"></i>';
    }

}

function loadMostSoldChart() {

    const ctx = document.getElementById('msChart');

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;

            var data = JSON.parse(response);
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: ' Sold Items',
                        data: data.data,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

        }
    };

    request.open("POST", "loadMostSoldChartProcess.php", true);
    request.send();

}

function loadLowStockChart() {

    const ctx = document.getElementById('lsChart');

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;

            var data = JSON.parse(response);
            new Chart(ctx, {
                type: 'polarArea',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: ' Products Left',
                        data: data.data,
                        borderWidth: 2
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

        }
    };

    request.open("POST", "loadLowStockChartProcess.php", true);
    request.send();

}

function loadUser(x) {

    var page = x;
    var resultBox = document.getElementById("tb");

    var f = new FormData();
    f.append("p", page);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4 & request.status == 200) {
            var response = request.responseText;
            resultBox.innerHTML = "";
            resultBox.innerHTML = response;
        }
    };

    request.open("POST", "loadUserProcess.php", true);
    request.send(f);

}

function searchUser(x) {

    var page = x;
    var User = document.getElementById("uid");
    var resultBox = document.getElementById("tb");

    var f = new FormData();
    f.append("ut", User.value);
    f.append("pg", page);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 & request.status == 200) {
            var response = request.responseText;
            resultBox.innerHTML = "";
            resultBox.innerHTML = response;
        }
    };

    request.open("POST", "searchUserProcess.php", true);
    request.send(f);

}

function updateUserStatus(user_id) {

    var userId = user_id;

    var f = new FormData();
    f.append("userId", userId);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            if (response == "Success") {
                loadUser(0);
            }
        }
    }

    request.open("POST", "updateUserStatusProcess.php", true);
    request.send(f);

}

function loadBrand() {

    var category = document.getElementById("category").value;
    var brand = document.getElementById("brand");

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            brand.innerHTML = response;
        }
    }

    request.open("GET", "loadBrand.php?c=" + category, true);
    request.send();

}

function addNewCategory() {

    var newCategory = document.getElementById("newcategory");

    var f = new FormData();
    f.append("nc", newCategory.value);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            alert(response);
            loadCategory();
            newCategory.value = "";
        }
    }

    request.open("POST", "addNewCategoryProcess.php", true);
    request.send(f);

}

var bm;

function showCHBModal() {

    var chbModal = document.getElementById("chbModal");
    var modalCategory = document.getElementById("modalCategory");

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            bm = new bootstrap.Modal(chbModal);
            bm.show();
            modalCategory.innerHTML = response;
        }
    }

    request.open("GET", "loadCategory.php", true);
    request.send();

}

function addNewBrand() {

    var newBrand = document.getElementById("newbrand");
    var modalCategory = document.getElementById("modalCategory");

    var f = new FormData();
    f.append("nb", newBrand.value);
    f.append("mc", modalCategory.value);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            bm.hide();
            alert(response);
            newBrand.value = "";
        }
    }

    request.open("POST", "addNewBrandProcess.php", true);
    request.send(f);

}

function regProduct() {

    var name = document.getElementById("pname");
    var img = document.getElementById("file");
    var category = document.getElementById("category");
    var brand = document.getElementById("brand");
    var description = document.getElementById("desc");

    var f = new FormData();
    f.append("pn", name.value);
    f.append("pimg", img.files[0]);
    f.append("c", category.value);
    f.append("b", brand.value);
    f.append("d", description.value);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            if (response == "empty") {
                alert("Please select a Image!");
            } else {
                alert(response);
                if (response == "Success") {
                    window.location = "adminStock.php";
                }
            }
        }
    }

    request.open("POST", "registerProductProcess.php", true);
    request.send(f);

}

function loadCurrentStock() {

    var product = document.getElementById("selectProduct");
    var currentQty = document.getElementById("csq");
    var price = document.getElementById("unitPrice");

    var f = new FormData();
    f.append("sp", product.value);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;

            if (response == "empty") {
                currentQty.innerHTML = "0";
                price.value = "";
            } else {

                //Get JSON and pass the values
                var currentStock = JSON.parse(response);
                currentQty.innerHTML = currentStock.qty;
                price.value = currentStock.unitPrice;
            }
        }
    }

    request.open("POST", "loadCurrentStockProcess.php", true);
    request.send(f);

}

function updateStock() {

    var product = document.getElementById("selectProduct");
    var qty = document.getElementById("qty");
    var price = document.getElementById("unitPrice");

    var f = new FormData();
    f.append("sp", product.value);
    f.append("qty", qty.value);
    f.append("up", price.value);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            alert(response);
            location.reload();
        }
    }

    request.open("POST", "updateStockProcess.php", true);
    request.send(f);

}
