// header alert
function hideAlert() {
  document.getElementById("msgdiv-1").className = "d-none";
  document.getElementById("msgdiv-2").className = "d-none";
  document.getElementById("msgdiv-3").className = "d-none";
  document.getElementById("msgdiv-4").className = "d-none";
  document.getElementById("msgdiv-5").className = "d-none";
}

function changeView() {
  var signUpBox = document.getElementById("signUpBox");
  var signInBox = document.getElementById("signInBox");

  signUpBox.classList.toggle("d-none");
  signInBox.classList.toggle("d-none");
}
// ----------------------------------------signup---------------------------

function signUp() {
  var firstname = document.getElementById("firstname");
  var lastname = document.getElementById("lastname");
  var email = document.getElementById("email");
  var password = document.getElementById("password");
  var mobile = document.getElementById("mobile");
  var gender = document.getElementById("gender");

  var form = new FormData();
  form.append("fname", firstname.value);
  form.append("lname", lastname.value);
  form.append("email", email.value);
  form.append("password", password.value);
  form.append("mobile", mobile.value);
  form.append("gender", gender.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var respons = request.responseText;
      if (respons == "Success") {
        document.getElementById("msg").innerHTML = respons;
        document.getElementById("msg").className = "bi bi-check2-circle fs-6";
        document.getElementById("alertdiv").className = "alert alert-info";
        document.getElementById("msgdiv").className = "d-block";
      } else {
        document.getElementById("msg").innerHTML = respons;
        document.getElementById("msgdiv").className = "d-block";
      }
      // alert(respons);
    }
  };
  request.open("POST", "signUpProcess.php", true);
  request.send(form);
}

// ----------------------------------------------signin------------------------------------

function signInProcess() {
  var email = document.getElementById("signEmail");
  var password = document.getElementById("signPassword");
  var rememberme = document.getElementById("rememberMe");

  var form = new FormData();
  form.append("signEmail", email.value);
  form.append("signPassword", password.value);
  form.append("rememberMe", rememberme.checked);

  var request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var respons = request.responseText;
      if (respons == "success") {
        window.location = "home.php";
      } else {
        document.getElementById("msg2").innerHTML = respons;
        document.getElementById("msgdiv2").className = "d-block";
      }
    }
  };
  request.open("POST", "signInProcess.php", true);
  request.send(form);
}

// -----------------------------------------------forgotPassword---------------------
var sm;
var bm;
function forgotPassword() {
  var signEmail = document.getElementById("signEmail");

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "Success") {
        alert(
          "Verification code has sent to your email. Please check your inbox"
        );
        var m = document.getElementById("forgotPassword");
        bm = new bootstrap.Modal(m);
        bm.show();
      } else {
        alert(t);
      }
    }
  };

  r.open("GET", "forgotPasswordProcess.php?email=" + signEmail.value, true);
  r.send();
}

function showPassword1() {
  var newPassword = document.getElementById("newPassword");
  var eye1 = document.getElementById("eye1");

  if (newPassword.type == "password") {
    newPassword.type = "text";
    eye1.className = "bi bi-eye-fill";
  } else {
    newPassword.type = "password";
    eye1.className = "bi bi-eye-slash-fill";
  }
}

function showPassword2() {
  var confirmNewPassword = document.getElementById("confirmNewPassword");
  var eye2 = document.getElementById("eye2");

  if (confirmNewPassword.type == "password") {
    confirmNewPassword.type = "text";
    eye2.className = "bi bi-eye-fill";
  } else {
    confirmNewPassword.type = "password";
    eye2.className = "bi bi-eye-slash-fill";
  }
}

function confirmP() {
  var signEmail = document.getElementById("signEmail");
  var newPassword = document.getElementById("newPassword");
  var confirmNewPassword = document.getElementById("confirmNewPassword");
  var verificationCode = document.getElementById("verificationCode");

  var form = new FormData();

  form.append("email", signEmail.value);
  form.append("newPassword", newPassword.value);
  form.append("confirmNewPassword", confirmNewPassword.value);
  form.append("verificationCode", verificationCode.value);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        bm.hide();
        alert("Password Reset Success");
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "confirmPassword.php", true);
  r.send(form);
}

function signOut() {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        window.location.reload();
      } else {
        alert(t);
      }
    }
  };
  r.open("GET", "signOutProcess.php", true);
  r.send();
}

function sort(x) {
  var search = document.getElementById("search");
  var time = 0;

  if (document.getElementById("nto").checked) {
    time = "1";
  } else if (document.getElementById("otn").checked) {
    time = "2";
  }

  var qty = "0";

  if (document.getElementById("htl").checked) {
    qty = "1";
  } else if (document.getElementById("lth").checked) {
    qty = "2";
  }

  var condition = "0";

  if (document.getElementById("bn").checked) {
    condition = "1";
  } else if (document.getElementById("u").checked) {
    condition = "2";
  }

  var f = new FormData();
  f.append("search", search.value);
  f.append("time", time);
  f.append("qty", qty);
  f.append("condition", condition);
  f.append("page", x);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      document.getElementById("sort").innerHTML = t;
    }
  };

  r.open("POST", "sortProcess.php", true);
  r.send(f);
}

function clearSort() {
  window.location.reload();
}

// ----------------------------------------addproduct image uplode-------------------------------------------------

function changeProductImage() {
  var image = document.getElementById("imageUploader");

  image.onchange = function () {
    var file_count = image.files.length;

    if (file_count <= 3) {
      for (var x = 0; x < file_count; x++) {
        var file = this.files[x];
        var url = window.URL.createObjectURL(file);

        document.getElementById("i" + x).src = url;
      }
    } else {
      alert("Please Select 3 or less then 3 Images.");
    }
  };
}
// ----------------------------------------addproduct image uplode-------------------------------------------------

// ----------------------------------------addproduct -------------------------------------------------

function addProduct() {
  var category = document.getElementById("category");
  var brand = document.getElementById("brand");
  var model = document.getElementById("model");
  var title = document.getElementById("title");
  var condition = 0;
  if (document.getElementById("b").checked) {
    condition = 1;
  } else if (document.getElementById("u").checked) {
    condition = 1;
  }

  var color = document.getElementById("color");
  var color_in = document.getElementById("color_in");
  var qty = document.getElementById("qty");
  var cost = document.getElementById("cost");
  var dcwc = document.getElementById("dcwc");
  var dcoc = document.getElementById("dcoc");
  var text = document.getElementById("text");
  var image = document.getElementById("imageUploader");

  var f = new FormData();
  f.append("ca", category.value);
  f.append("b", brand.value);
  f.append("m", model.value);
  f.append("t", title.value);
  f.append("co", color.value);
  f.append("ci", color_in.value);
  f.append("qty", qty.value);
  f.append("cost", cost.value);
  f.append("dcwc", dcwc.value);
  f.append("dcoc", dcoc.value);
  f.append("txt", text.value);
  f.append("con", condition);

  var file_count = image.files.length;

  for (var x = 0; x < file_count; x++) {
    f.append("image" + x, image.files[x]);
  }

  var respons = new XMLHttpRequest();

  respons.onreadystatechange = function () {
    if (respons.readyState == 4) {
      var responsetext = respons.responseText;

      if (responsetext == "Product image Saved Successfully") {
        document.getElementById("msg-1").className =
          "bi bi-exclamation-triangle-fill";
        document.getElementById("alertdiv-1").classList = "alert alert-danger ";
        document.getElementById("msg-1").innerHTML = responsetext;
        document.getElementById("msgdiv-1").className = "d-block";
        window.location.reload();
      } else {
        document.getElementById("msg-1").className =
          "bi bi-check-circle-fill";
        document.getElementById("alertdiv-1").classList = "alert alert-primary";
        document.getElementById("msg-1").innerHTML = responsetext;
        document.getElementById("msgdiv-1").className = "d-block";
      }
    }
  };

  respons.open("POST", "addProductProcess.php", true);
  respons.send(f);
}
// ----------------------------------------addproduct -------------------------------------------------

//------------------------------------------updateprofile----------------------------------------------

function changeImage() {
  var viewImg = document.getElementById("img");
  var file = document.getElementById("profileimg");

  file.onchange = function () {
    var file1 = this.files[0];
    var url = window.URL.createObjectURL(file1);
    viewImg.src = url;
  };
}

function updateProfile() {
  var fname = document.getElementById("fname");
  var lname = document.getElementById("lname");
  var mobile = document.getElementById("mobile");
  var line1 = document.getElementById("line1");
  var line2 = document.getElementById("line2");
  var province = document.getElementById("provinces");
  var district = document.getElementById("district");
  var city = document.getElementById("city");
  var postalcode = document.getElementById("postalcode");
  var image = document.getElementById("profileimg");

  var f = new FormData();
  f.append("fn", fname.value);
  f.append("ln", lname.value);
  f.append("m", mobile.value);
  f.append("li1", line1.value);
  f.append("li2", line2.value);
  f.append("pro", province.value);
  f.append("dis", district.value);
  f.append("ci", city.value);
  f.append("pos", postalcode.value);

  if (image.files.length == 0) {
    var confirmation = confirm(
      "Are you sure you don't want to update profile Image?"
    );

    if (confirmation) {
      alert("You have not selected any Image");
    }
  } else {
    f.append("image", image.files[0]);
  }

  var respons = new XMLHttpRequest();

  respons.onreadystatechange = function () {
    if (respons.readyState == 4) {
      var responseText = respons.responseText;
      if (responseText == "success") {
        window.location.reload();
      } else {
        alert(responseText);
      }
    }
  };

  respons.open("POST", "updateProfileProcess.php", true);
  respons.send(f);
}

// -----------------------------------changeStatus--------------

function changeStatus(id) {
  var product_id = id;

  var respons = new XMLHttpRequest();

  respons.onreadystatechange = function () {
    if (respons.readyState == 4) {
      var responstext = respons.responseText;

      if (responstext == "deactivated") {
        alert("Product Deactivated");
        window.location = "myProducts.php";
      } else if (responstext == "activated") {
        alert("Product Activated");
        window.location = "myProducts.php";
      } else {
        alert(responstext);
      }
    }
  };

  respons.open("GET", "changeStatusProcess.php?p=" + product_id, true);
  respons.send();
}

// -----------------------------------------product update--------------

function sendId(id) {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        window.location = "updateProduct.php";
      } else {
        alert(t);
      }
    }
  };

  r.open("GET", "sendIdProcess.php?id=" + id, true);
  r.send();
}

// ---------------------------------------------updateproduct---------------------

function updateProduct(id) {
  // alert("ok");
  var title = document.getElementById("title");
  var qty = document.getElementById("qty");
  var dcwc = document.getElementById("dcwc");
  var dcoc = document.getElementById("dcoc");
  var description = document.getElementById("ds");
  var images = document.getElementById("imageUploader");

  var f = new FormData();

  f.append("t", title.value);
  f.append("q", qty.value);
  f.append("dcwc", dcwc.value);
  f.append("dcoc", dcoc.value);
  f.append("d", description.value);

  var file_count = images.files.length;

  for (var x = 0; x < file_count; x++) {
    f.append("i" + x, images.files[x]);
  }

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      // alert(t);
      if (t == "success") {
        document.getElementById("msg-1").className =
          "bi bi-exclamation-triangle-fill";
        document.getElementById("alertdiv-1").classList = "alert alert-danger ";
        document.getElementById("msg-1").innerHTML = t;
        document.getElementById("msgdiv-1").className = "d-block";
        window.location.reload();
      } else {
        document.getElementById("msg-1").className =
          "bi bi-check-circle-fill";
        document.getElementById("alertdiv-1").classList = "alert alert-primary";
        document.getElementById("msg-1").innerHTML = t;
        document.getElementById("msgdiv-1").className = "d-block";
      }
    }
  };

  r.open("POST", "updateProcess.php", true);
  r.send(f);
}

// -----------------------------------------advancedSearch-----------------------------

function advancedSearch(x) {
  var text = document.getElementById("txt");
  var category = document.getElementById("category");
  var model = document.getElementById("model");
  var brand = document.getElementById("brand");
  var color = document.getElementById("color");
  var priceFrom = document.getElementById("pr");
  var priceTo = document.getElementById("pt");
  var sort = document.getElementById("sort");
  var condition = document.getElementById("con");

  var form = new FormData();
  form.append("t", text.value);
  form.append("ca", category.value);
  form.append("m", model.value);
  form.append("b", brand.value);
  form.append("c", color.value);
  form.append("pf", priceFrom.value);
  form.append("pt", priceTo.value);
  form.append("s", sort.value);
  form.append("co", condition.value);
  form.append("page", x);

  var respons = new XMLHttpRequest();

  respons.onreadystatechange = function () {
    if (respons.readyState == 4) {
      var text = respons.responseText;
      document.getElementById("view_area").innerHTML = text;
    }
  };

  respons.open("POST", "advancedSearchProcess.php", true);
  respons.send(form);
}
// ----------------------------------------addwatchlist--------------------------

function addToWatchlist(id) {
  // alert(id);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;

      if (t == "removed") {
        document.getElementById("plus" + id).style.className = "text-dark";
        window.location.reload();
      } else if (t == "added") {
        document.getElementById("plus" + id).style.className = "text-danger";
        window.location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("GET", "watchlistProcess.php?id=" + id, true);
  r.send();
}
// -------------------removeFromWatchlist-------------

function removeFromWatchlist(id) {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;

      if (t == "success") {
        window.location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("GET", "removeWatchlistProcess.php?id=" + id, true);
  r.send();
}

function addToCart(id) {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      alert(t);
    }
  };

  r.open("GET", "addToCartProcess.php?id=" + id, true);
  r.send();
}

// ---------------------------deleteFromCart------------

function deleteFromCart(id) {
  var respons = new XMLHttpRequest();

  respons.onreadystatechange = function () {
    if (respons.readyState == 4) {
      var t = respons.responseText;
      if (t == "success") {
        window.location.reload();
      } else {
        alert(t);
      }
    }
  };

  respons.open("GET", "deleteToCartProcess.php?id=" + id, true);
  respons.send();
}

// ------------------------------- singlproductview qty input-------------------

function checkValues(qty) {
  var input = document.getElementById("qty_input");

  if (input.value <= 0) {
    alert("Quantity must be 1 or more");
  } else if (input.value > qty) {
    alert("Maximum Quantity Achieved");
  }
}

function qty_dec() {
  var input = document.getElementById("qty_input");

  if (input.value > 1) {
    var newValue = parseInt(input.value) - 1;
    input.value = newValue.toString();
  } else {
    alert("Minimum Quantity has achieved");
    input.value = 1;
  }
}
// ----------------------basicsearch------------------------------
function basicSearch(x) {
  var txt = document.getElementById("basicSearchText");
  var select = document.getElementById("basicSearchSelect");

  var form = new FormData();
  form.append("t", txt.value);
  form.append("s", select.value);
  form.append("page", x);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      document.getElementById("basicRsesult").innerHTML = t;
    }
  };
  r.open("POST", "basicSearchProcess.php", true);
  r.send(form);
}

// ---------------------------printInovice-------------------

function printInovice() {
  var body = document.body.innerHTML;
  var page = document.getElementById("page").innerHTML;
  document.body.innerHTML = page;
  window.print();
  document.body.innerHTML = body;
}

// --------------create_pdf------------------

function downloadPDF() {
  var invoice = document.getElementById("page");
  console.log(invoice);
  console.log(window);
  var opt = {
    margin: 0,
    filename: "invoice.pdf",
    image: { type: "jpeg", quality: 0.98 },
    html2canvas: { scale: 2 },
    jsPDF: { unit: "in", format: "letter", orientation: "portrait" },
  };
  html2pdf().from(invoice).set(opt).save();
}

// --------------------productb  buynow-----------------------------


// ------------------------invoice save------------------------

function saveInvoice(orderId, id, mail, amount, qty) {
  var f = new FormData();

  f.append("o", orderId);
  f.append("i", id);
  f.append("m", mail);
  f.append("a", amount);
  f.append("q", qty);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;

      if (t == 1) {
        window.location = "invoice.php?id=" + orderId;
      } else {
        alert(t);
      }
    }
  };
  r.open("POST", "saveInvoice.php", true);
  r.send(f);
}
// -----------------------feedback process---------------------


function addFeedback(id) {
  window.location = "feedback.php?id=" + id;
}
// ---------------------------saveFeedback---------------

// function saveFeedback(id) {
//   var type;

//   if (document.getElementById("type1").checked) {
//     type = 1;
//   } else if (document.getElementById("type2").checked) {
//     type = 2;
//   } else if (document.getElementById("type3").checked) {
//     type = 3;
//   }

//   var feedback = document.getElementById("feedback").value;

//   var f = new FormData();
//   f.append("pid", id);
//   f.append("t", type);
//   f.append("feedback", feedback);

//   var r = new XMLHttpRequest();

//   r.onreadystatechange = function () {
//     if (r.readyState == 4) {
//       var t = r.responseText;
//       if (t == "1") {
//         fe.hide();
//       } else {
//         alert(t);
//       }
//     }
//   };
//   r.open("POST", "saveFeedbackProcess.php", true);
//   r.send(f);
// }

// ----------------------------------deletePurchasingHistory-----------------------------

function deletePurchasingHistory() {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        window.location.reload();
      } else {
        alert(t);
      }
    }
  };
  r.open("GET", "deletePurchasingHistory.php", true);
  r.send();
}

// --------------------viewMessages-------------------

function viewMessages(email) {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      document.getElementById("chat_box").innerHTML = t;
    }
  };

  r.open("GET", "veiwMessageProcess.php?e=" + email, true);
  r.send();
}

// sed_msg

function send_msg() {
  var email = document.getElementById("rmail");
  var txt = document.getElementById("msg_txt");

  var f = new FormData();
  f.append("e", email.innerHTML);
  f.append("t", txt.value);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        window.location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "sendMsgProcess.php", true);
  r.send(f);
}

// contactadminmsg

var contactadminmsg;

function contactAdminMsg() {
  var model = document.getElementById("contactAdminMsg");
  contactadminmsg = new bootstrap.Modal(model);
  contactadminmsg.show();
}

function adminSendMsg() {
  var msgText = document.getElementById("typeMsg").value;

  var f = new FormData();
  f.append("text", msgText);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      alert(t);
    }
  };
  r.open("POST", "sendAdminMessageProcess.php", true);
  r.send(f);
}
function adminSendMsg(email) {
  var msgText = document.getElementById("typeMsg").value;


  var f = new FormData();
  f.append("text", msgText);
  f.append("mail", email);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;

      if (t == "1") {
        window.location.reload();
      } else if (t == "2") {
        window.location.reload();
      } else {
        alert(t);
      }
    }
  };
  r.open("POST", "sendAdminMessageProcess.php", true);
  r.send(f);
}
// adminverification

var avm;

function adminVerification() {
  var adminEmail = document.getElementById("adminEmail");

  var form = new FormData();
  form.append("adEmail", adminEmail.value);

  var respons = new XMLHttpRequest();
  respons.onreadystatechange = function () {
    if (respons.readyState == 4) {
      var responstxt = respons.responseText;

      if (responstxt == "Success") {
        var verifiyModel = document.getElementById("adminVerification");
        avm = new bootstrap.Modal(verifiyModel);
        avm.show();
      } else {
        alert(responstxt);
      }
    }
  };
  respons.open("POST", "adminVerificationProcess.php", true);
  respons.send(form);
}
function verifiy() {
  var verifiyCode = document.getElementById("verifiyCode");
  var respons = new XMLHttpRequest();
  respons.onreadystatechange = function () {
    if (respons.readyState == 4) {
      var responstxt = respons.responseText;

      if (responstxt == "Success") {
        avm.hide();
        window.location = "adminPenal.php";
      } else {
        alert(responstxt);
      }
    }
  };
  respons.open(
    "GET",
    "adminVerifiyProcess.php?verifiyCode=" + verifiyCode.value,
    true
  );
  respons.send();
}

// admin profile update
var adminModel;

function adminProfileUpdate() {
  var model = document.getElementById("adminProfileUpdate");
  adminModel = new bootstrap.Modal(model);
  adminModel.show();
}

function changeImage() {
  var viewImg = document.getElementById("img");
  var file = document.getElementById("profileimg");

  file.onchange = function () {
    var file1 = this.files[0];
    var url = window.URL.createObjectURL(file1);
    viewImg.src = url;
  };
}

function updateAdminProfile() {
  var fname = document.getElementById("fname");
  var lname = document.getElementById("lname");
  var image = document.getElementById("profileimg");

  var form = new FormData();
  form.append("fname", fname.value);
  form.append("lname", lname.value);

  if (image.files.length == 0) {
    var confirmation = confirm(
      "Are you sure you don't want to update profile Image?"
    );

    if (confirmation) {
      alert("You have not selected any Image");
    }
  } else {
    form.append("image", image.files[0]);
  }
  var respons = new XMLHttpRequest();

  respons.onreadystatechange = function () {
    if (respons.readyState == 4) {
      var responstxt = respons.responseText;
      if (responstxt == "success") {
        adminModel.hide();
        window.location.reload();
      } else {
        alert(responstxt);
      }
    }
  };
  respons.open("POST", "adminProfileUpadteProcess.php", true);
  respons.send(form);
}
// chengStatus manage user

function chengStatus(email) {
  var respons = new XMLHttpRequest();

  respons.onreadystatechange = function () {
    if (respons.readyState == 4) {
      var responstxt = respons.responseText;
      if (responstxt == "1") {
        document.getElementById("buttonStatus" + email).innerHTML = "Unblock";
        document.getElementById("buttonStatus" + email).classList =
          "btn btn-dark";
      } else if (responstxt == "2") {
        document.getElementById("buttonStatus" + email).innerHTML = "Block";
        document.getElementById("buttonStatus" + email).classList =
          "btn btn-primary";
      }
    }
  };
  respons.open("GET", "userManageProcess.php?email=" + email, true);
  respons.send();
}

// manage user /msg user/viwe model

var viewMsg;

function viewMsgModel(email) {

  var msgModel = document.getElementById("userMsg" + email);
  viewMsg = new bootstrap.Modal(msgModel);
  viewMsg.show();
}

// basicSearchAdmin penal

function basicSearchAdmin(x) {
  var text = document.getElementById("basicSearchText");

  var form = new FormData();
  form.append("t", text.value);
  form.append("page", x);

  var respons = new XMLHttpRequest();

  respons.onreadystatechange = function () {
    if (respons.readyState == 4) {
      var responstxt = respons.responseText;
      document.getElementById("basicRsesult").innerHTML = responstxt;
    }
  }

  respons.open("POST", "adminBasicSearchProcess.php", true);
  respons.send(form);
}

// basicSearchProductAdmin penal

function basicSearchAdminProduct(x) {

  var text = document.getElementById("basicSearchText");

  var form = new FormData();
  form.append("t", text.value);
  form.append("page", x);

  var respons = new XMLHttpRequest();

  respons.onreadystatechange = function () {
    if (respons.readyState == 4) {
      var responstxt = respons.responseText;
      document.getElementById("basicRsesult").innerHTML = responstxt;
    }
  }

  respons.open("POST", "productAdminBasicSearchProcess.php", true);
  respons.send(form);
}

// basicSearchsellingAdmin penal

function sellingHistorySearch(x) {
  var text = document.getElementById("basicSearchText");

  var form = new FormData();
  form.append("t", text.value);
  form.append("page", x);

  var respons = new XMLHttpRequest();

  respons.onreadystatechange = function () {
    if (respons.readyState == 4) {
      var responstxt = respons.responseText;
      document.getElementById("viewArea").innerHTML = responstxt;
    }
  }

  respons.open("POST", "sellingHistorySearchProcess.php", true);
  respons.send(form);
}
// chengStatus manage product

function blockProductChengStatus(id) {

  // alert("ok");
  var respons = new XMLHttpRequest();

  respons.onreadystatechange = function () {


    if (respons.readyState == 4) {
      var responstxt = respons.responseText;
      if (responstxt == "1") {
        document.getElementById("buttonStatus" + id).innerHTML = "Unblock";
        document.getElementById("buttonStatus" + id).classList =
          "btn btn-dark";
      } else if (responstxt == "2") {
        document.getElementById("buttonStatus" + id).innerHTML = "Block";
        document.getElementById("buttonStatus" + id).classList =
          "btn btn-warning";
      } else {
        alert(responstxt);
      }

    }
  };
  respons.open("GET", "productManageProcess.php?id=" + id, true);
  respons.send();
}
// manage product model detelis

var viewProductModel;

function productDetalisModel(id) {

  var productDetelisModel = document.getElementById("productDetalisModel" + id);
  viewProductModel = new bootstrap.Modal(productDetelisModel);
  viewProductModel.show();
}




// add new category 

// var newCategoryModel;

function newCategoryModel() {
  var newCategoryModel = document.getElementById("newCategoryModel");
  categoryModel = new bootstrap.Modal(newCategoryModel);
  categoryModel.show();
}

var categoryVerifi;
var categoryModel;

function verifiNewCategory() {
  var categoryVerificationModel = document.getElementById("addCategoryVerificationModal");
  categoryVerifi = new bootstrap.Modal(categoryVerificationModel);

  newCategory = document.getElementById("newCategory").value;
  email = document.getElementById("email").value;



  var form = new FormData();
  form.append("newCategory", newCategory);
  form.append("email", email);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4 & request.status == 200) {
      var requestext = request.responseText;
      if (requestext == "Success") {
        categoryModel.hide();
        categoryVerifi.show();
      } else {
        document.getElementById("msg-1").className =
          "bi bi-exclamation-triangle-fill";
        document.getElementById("alertdiv-1").classList = "alert alert-danger";
        document.getElementById("msg-1").innerHTML = requestext;
        document.getElementById("msgdiv-1").className = "d-block";
      }
    }
  }

  request.open("POST", "newAddCategoryProcess.php", true);
  request.send(form);
}

// verifiCategory

function verifiCategory() {
  var verificationCode = document.getElementById("verificationCode").value;

  var form = new FormData();
  form.append("verificationCode", verificationCode);
  form.append("newCategory", newCategory);
  form.append("email", email);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4 & request.status == 200) {
      var responstext = request.responseText;

      if (responstext == "success") {
        categoryVerifi.hide();
        window.location.reload();
      } else {
        document.getElementById("msg-1").className =
          "bi bi-exclamation-triangle-fill";
        document.getElementById("alertdiv-1").classList = "alert alert-danger";
        document.getElementById("msg-1").innerHTML = responstext;
        document.getElementById("msgdiv-1").className = "d-block";
      }

    }
  }
  request.open("POST", "verifiCategoryProcces.php", true);
  request.send(form);
}


// admin product add 

function changeProductImage() {
  var image = document.getElementById("imageUploader");

  image.onchange = function () {
    var file_count = image.files.length;

    if (file_count <= 3) {
      for (var x = 0; x < file_count; x++) {
        var file = this.files[x];
        var url = window.URL.createObjectURL(file);

        document.getElementById("i" + x).src = url;
      }
    } else {
      alert("Please Select 3 or less then 3 Images.");
    }
  };
}



function productAdd() {
  var category = document.getElementById("category");
  var brand = document.getElementById("brand");
  var model = document.getElementById("model");
  var sellerEmail = document.getElementById("sellerEmail");
  var title = document.getElementById("title");
  var condition = 0;
  if (document.getElementById("b").checked) {
    condition = 1;
  } else if (document.getElementById("u").checked) {
    condition = 1;
  }

  var color = document.getElementById("color");
  var color_in = document.getElementById("color_in");
  var qty = document.getElementById("qty");
  var cost = document.getElementById("cost");
  var dcwc = document.getElementById("dcwc");
  var dcoc = document.getElementById("dcoc");
  var text = document.getElementById("text");
  var image = document.getElementById("imageUploader");

  var f = new FormData();
  f.append("ca", category.value);
  f.append("b", brand.value);
  f.append("m", model.value);
  f.append("sellerEmail", sellerEmail.value);
  f.append("t", title.value);
  f.append("co", color.value);
  f.append("ci", color_in.value);
  f.append("qty", qty.value);
  f.append("cost", cost.value);
  f.append("dcwc", dcwc.value);
  f.append("dcoc", dcoc.value);
  f.append("txt", text.value);
  f.append("con", condition);

  var file_count = image.files.length;

  for (var x = 0; x < file_count; x++) {
    f.append("image" + x, image.files[x]);
  }

  var respons = new XMLHttpRequest();

  respons.onreadystatechange = function () {
    if (respons.readyState == 4) {
      var responsetext = respons.responseText;
      // alert(responsetext);

      if (responsetext == "Product image Saved Successfully") {
        document.getElementById("msg-1").className =
          "bi bi-exclamation-triangle-fill";
        document.getElementById("alertdiv-1").classList = "alert alert-danger ";
        document.getElementById("msg-1").innerHTML = responsetext;
        document.getElementById("msgdiv-1").className = "d-block";
        window.location.reload();
      } else {
        document.getElementById("msg-1").className =
          "bi bi-check-circle-fill";
        document.getElementById("alertdiv-1").classList = "alert alert-primary";
        document.getElementById("msg-1").innerHTML = responsetext;
        document.getElementById("msgdiv-1").className = "d-block";
      }
    }
  };

  respons.open("POST", "adminProductAddedProcess.php", true);
  respons.send(f);
}


// onload category 

function brand_load() {
  var category = document.getElementById("category").value;

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4 & request.status == 200) {
      var respons = request.responseText;
      document.getElementById("brand").innerHTML = respons;
    }
  }

  request.open("GET", "brandLoadProcess.php?category=" + category, true);
  request.send();
}

// loadmodel

function load_model() {
  var brand = document.getElementById("brand").value;

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4 & request.status == 200) {
      var respons = request.responseText;
      document.getElementById("model").innerHTML = respons;
    }
  }

  request.open("GET", "modelLoadProcess.php?brand=" + brand, true);
  request.send();
}

// selling History change invoice button

function changeInvoice(id) {

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var respons = request.responseText;

      if (respons == 1) {
        document.getElementById("changeBtn" + id).innerHTML = "Packing";
        document.getElementById("changeBtn" + id).classList = "btn btn-warning";
      } else if (respons == 2) {
        document.getElementById("changeBtn" + id).innerHTML = "Dispatch";
        document.getElementById("changeBtn" + id).classList = "btn btn-secondary";
      } else if (respons == 3) {
        document.getElementById("changeBtn" + id).innerHTML = "Shipping";
        document.getElementById("changeBtn" + id).classList = "btn btn-primary";
      } else if (respons == 4) {
        document.getElementById("changeBtn" + id).innerHTML = "Delivered";
        document.getElementById("changeBtn" + id).classList = "btn btn-success disabled";
      } else {
        document.getElementById("msg-1").className =
          "bi bi-exclamation-triangle-fill";
        document.getElementById("alertdiv-1").classList = "alert alert-danger";
        document.getElementById("msg-1").innerHTML = respons;
        document.getElementById("msgdiv-1").className = "d-block";
      }


    }
  }

  request.open("GET", "chaneInvoiceProcess.php?id=" + id, true);
  request.send();

}




// delete product

function deleteProduct(id) {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var respons = request.responseText;

      if (respons == "success") {
        window.location.reload();
      } else {
        alert(respons);
      }
    }
  }

  request.open("GET", "deleteProductProcess.php?id=" + id, true);
  request.send();

}

// upload product

function uploadProduct(id) {


  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var respons = request.responseText;

      if (respons == "success") {
        window.location.reload();
      } else {
        alert(respons);
      }
    }
  }

  request.open("GET", "uploadProductProcess.php?id=" + id, true);
  request.send();

}

// adminsign out 

function adminSignOut() {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        window.location = "adminLogin.php";
      } else {
        alert(t);
      }
    }
  };
  r.open("GET", "adminSignOutProcess.php", true);
  r.send();
}

// delete category

function deleteCategory(id) {
  var request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var respons = request.responseText;
      if (respons == "1") {
        window.location.reload();
      } else {
        alert(respons);
      }

    }
  }
  request.open("GET", "deleteCategoryProcess.php?id=" + id, true);
  request.send();
}

// add new model



var modelVerifi;
var modelModel;
function newModelModel() {
  var newModelModel = document.getElementById("newModelModel");
  modelModel = new bootstrap.Modal(newModelModel);
  modelModel.show();
}

function verifiNewModel() {
  var addModelVerificationModal = document.getElementById("addModelVerificationModal");
  modelVerifi = new bootstrap.Modal(addModelVerificationModal);

  newModel = document.getElementById("newModel").value;
  modelTonewEmail = document.getElementById("modelTonewEmail").value;



  var form = new FormData();
  form.append("newModel", newModel);
  form.append("modelTonewEmail", modelTonewEmail);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4 & request.status == 200) {
      var requestext = request.responseText;
      if (requestext == "Success") {
        modelModel.hide();
        modelVerifi.show();
      } else {
        document.getElementById("msg-1").className =
          "bi bi-exclamation-triangle-fill";
        document.getElementById("alertdiv-1").classList = "alert alert-danger";
        document.getElementById("msg-1").innerHTML = requestext;
        document.getElementById("msgdiv-1").className = "d-block";
        // alert(requestext)
      }
    }
  }

  request.open("POST", "newAddModelProcess.php", true);
  request.send(form);
}

// verifiCategory

function verifiModel() {
  var verificationCode2 = document.getElementById("newModelverificationCode").value;

  var form = new FormData();
  form.append("newModelverificationCode", verificationCode2);
  form.append("newModel", newModel);
  form.append("modelTonewEmail", modelTonewEmail);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4 & request.status == 200) {
      var responstext = request.responseText;

      if (responstext == "success") {
        modelVerifi.hide();
        window.location.reload();
      } else {
        document.getElementById("msg-1").className =
          "bi bi-exclamation-triangle-fill";
        document.getElementById("alertdiv-1").classList = "alert alert-danger";
        document.getElementById("msg-1").innerHTML = responstext;
        document.getElementById("msgdiv-1").className = "d-block";
        // alert(responstext);
      }

    }
  }
  request.open("POST", "verifiModelProcces.php", true);
  request.send(form);
}

// add new brand



var brandVerifi;
var brandModel;
function newBrandModel() {
  var newbrandModel = document.getElementById("newBrandModel");
  brandModel = new bootstrap.Modal(newbrandModel);
  brandModel.show();
}

function verifiNewBrand() {
  var addBrandVerificationModal = document.getElementById("addBrandVerificationModal");
  brandVerifi = new bootstrap.Modal(addBrandVerificationModal);

  newBrand = document.getElementById("newBrand").value;
  brandTonewEmail = document.getElementById("brandTonewEmail").value;
  selectBrandCategory = document.getElementById("selectBrandCategory").value;



  var form = new FormData();
  form.append("newBrand", newBrand);
  form.append("brandTonewEmail", brandTonewEmail);
  form.append("selectBrandCategory", selectBrandCategory)

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4 & request.status == 200) {
      var requestext = request.responseText;
      if (requestext == "Success") {
        brandModel.hide();
        brandVerifi.show();
      } else {
        document.getElementById("msg-3").className =
          "bi bi-exclamation-triangle-fill";
        document.getElementById("alertdiv-3").classList = "alert alert-danger";
        document.getElementById("msg-3").innerHTML = requestext;
        document.getElementById("msgdiv-3").className = "d-block";
        // alert(requestext)
      }
    }
  }

  request.open("POST", "newAddBrandProcess.php", true);
  request.send(form);
}

// verifiCategory

function verifiBrand() {
  var verificationCode2 = document.getElementById("newBrandverificationCode").value;

  var form = new FormData();
  form.append("newBrandverificationCode", verificationCode2);
  form.append("newBrand", newBrand);
  form.append("brandTonewEmail", brandTonewEmail);
  form.append("selectBrandCategory", selectBrandCategory)


  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4 & request.status == 200) {
      var responstext = request.responseText;

      if (responstext == "success") {
        brandVerifi.hide();
        window.location.reload();
      } else {
        document.getElementById("msg-3").className =
          "bi bi-exclamation-triangle-fill";
        document.getElementById("alertdiv-3").classList = "alert alert-danger";
        document.getElementById("msg-3").innerHTML = responstext;
        document.getElementById("msgdiv-3").className = "d-block";
        // alert(responstext);
      }

    }
  }
  request.open("POST", "verifiBrandProcces.php", true);
  request.send(form);
}

// delete model

function deletemodel(id) {
  var request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var respons = request.responseText;
      if (respons == "1") {
        window.location.reload();
      } else {
        alert(respons);
      }
      
    }
  }
  request.open("GET", "deleteModelProcess.php?id=" + id, true);
  request.send();
}

// purchsing product dalete

function productDelete(id) {
  // alert(id);
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        window.location.reload();
      } else {
        alert(t);
      }
    }
  };
  r.open("GET", "productDeleteHistory.php?id=" + id, true);
  r.send();
}

// function payment(id) {
//   window.location = "payment.php?id=" + id;
// }
// product buy now 

var buyNow;

function payNow() {

  var buyProduct = document.getElementById("buyNow");
  buyNow = new bootstrap.Modal(buyProduct);


  var request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var respons = request.responseText;

      if (respons == "1") {
        window.location = "index.php";
      } else if (respons == "2") {
        window.location = "myProfile.php";
      } else if (respons != "1" && respons != "2") {
        buyNow.show();
      } else {
        alert(respons);
      }

    }
  }

  request.open("GET", "payNowProcess.php", true);
  request.send();

}
function buyNow() {

  var request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var respons = request.responseText;

      if (respons == "1") {
        alert(" Please Log In or  Sign Up");
      } else if (respons == "2") {
        alert(" Please Update Profile First.");
      } else if (respons != 1 && respons != 2) {
        var id = document.getElementById("id").value;
        var qty = document.getElementById("qty_input").value;
        var title = document.getElementById("title").value;
        var price = document.getElementById("price").value;
        var deliveryFee = document.getElementById("deliveryFee").value;
        var amount = document.getElementById("price").value;
        var amount = parseInt(price) * parseInt(qty) + parseInt(deliveryFee);


        window.location="payment.php?id="+id + "&qty="+ qty +"&title=" +title + "&amount="+amount;
      }else{
        alert(respons);
      }

    }
  }

  request.open("GET", "payNowProcess.php", true);
  request.send();

}

// basicSearchProductUserAdmin

// function basicSearchProductUserAdmin(page){
//   var userText = document.getElementById("userText");
//   // var productText = document.getElementById("productText");

//   var form = new FormData();
//   form.append("userText", userText.value);
//   // form.append("productText", productText.value);
//   form.append("page", page);

//   var respons = new XMLHttpRequest();

//   respons.onreadystatechange = function () {
//     if (respons.readyState == 4) {
//       var responstxt = respons.responseText;
//       document.getElementById("basicRsesult").innerHTML = responstxt;
//     }
//   }

//   respons.open("POST", "adminBasicSearchProductUserProcess.php", true);
//   respons.send(form);
// }