

var fecha;
var dominio = "cdapruebas.tecmmas.com";
$(document).ready(function () {
  desactivarComponentes();
  fecha = new Date().toLocaleDateString("en-CA");
  // evalFun();
  getMac();
});


function getMac() {
  $.ajax({
    url: 'index.php/getmac/',
    type: 'get',
    dataType: 'json',
    async: true,
    success: function (data, textStatus, jqXHR) {
      sendMacAndDomain(data);
    },
    error: function (jqXHR, textStatus, errorThrown) {
      getMac2();
    }
  });
}

function getMac2() {
  $.ajax({
    url: 'getmac/',
    type: 'get',
    dataType: 'json',
    async: true,
    success: function (data, textStatus, jqXHR) {
      sendMacAndDomain(data);
    },
    error: function (jqXHR, textStatus, errorThrown) {
      //console.log('error')
      //console.log(jqXHR.responseText)
    }
  });
}

function sendMacAndDomain(mac) {
  $.ajax({
    url: 'https://appdataingeniersoftware.com/appdatacontrol/index.php/Cdispositivo',
    type: 'post',
    dataType: 'json',
    data: {
      mac: mac,
      dominio: dominio,
    },
    success: function (response) {
      //console.log('Response:', response);
      evalFun(response.estado);
    },
    error: function (jqXHR, textStatus, errorThrown) {
      //console.log('Error:', textStatus, errorThrown);
    }
  });
}


var evalFun = function (estado) {
  //console.log(estado);
  if (estado == 0 || estado == "0") {
    //console.log("Dispositivo inactivo");
    Swal.fire({
      'icon': 'error',
      'title': "Error",
      'allowOutsideClick': false,
      'allowEscapeKey': false,
      'showConfirmButton': false,
      'text': "Dispositivo inactivo, por favor comunicarse con el administrador del sistema.",
    });
    desactivarComponentes();
  } else {
   // console.log("entre");
    getLicencia();
  }
  // var licencia = localStorage.getItem("licencia");
  // if (licencia == null || licencia == undefined) {
  //   Swal.fire({
  //     'icon': "error",
  //     'title': "Error",
  //     'text': "Dispositivo inactivo"
  //   });
  // }
  // try {
  //   if (atob(localStorage.getItem("licencia")) !== "cdaappdatasoftwareenginer") {
  //     desactivarComponentes();
  //     Swal.fire({
  //       'icon': 'error',
  //       'title': 'Error',
  //       'text': "La licencia no es valida"
  //     });
  //   } else {
  //     getLicencia();
  //   }
  // } catch (_0xb55a64) {
  //   Swal.fire({
  //     'icon': 'error',
  //     'title': "Error",
  //     'text': "Dispositivo inactivo"
  //   });
  //   desactivarComponentes();
  // }
};

if (localStorage.getItem("juez") == 0x1) {
  $("#ali").css("cursor", "not-allowed");
  $('#ali').css('pointer-events', "none");
  $("#fre").css("cursor", "not-allowed");
  $("#fre").css("pointer-events", "none");
  $("#frem").css("cursor", "not-allowed");
  $('#frem').css("pointer-events", 'none');
  $("#sus").css("cursor", "not-allowed");
  $("#sus").css("pointer-events", "none");
  $('#opac').css("cursor", "not-allowed");
  $("#opac").css('pointer-events', 'none');
  $("#gase").css("cursor", "not-allowed");
  $("#gase").css('pointer-events', 'none');
  $("#gasem").css("cursor", 'not-allowed');
  $("#gasem").css('pointer-events', "none");
  $("#lux").css("cursor", "not-allowed");
  $("#lux").css('pointer-events', "none");
  $("#luxm").css("cursor", "not-allowed");
  $("#luxm").css("pointer-events", 'none');
  $('#son').css('cursor', "not-allowed");
  $('#son').css("pointer-events", "none");
}

function getLicencia() {
  fetch("https://appdataingeniersoftware.com/appdatacontrol/index.php/Cappdata?dominio=" + dominio, {
    'method': "GET",
    'headers': {
      'Autorization': "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.Ijg5NnNkYndmZTg3dmNzZGFmOTg0bmc4ZmdoMjRvMTI5MHIi.HraZ7y3eG3dGhKngzOWge-je8Y3lxZgldXjbRbcA7cA",
      'Content-Type': 'application/json'
    }
  }, 0x7d0).then(_0x224f34 => _0x224f34.json()).then(_0x24f98b => {
    localStorage.setItem("juez", _0x24f98b[0x0].valor);
    localStorage.setItem("date", _0x24f98b[0x0].fechavigencia);
    if (fecha > _0x24f98b[0x0].fechavigencia) {
      Swal.fire({
        'icon': "error",
        'title': "Licencia",
        'allowOutsideClick': false,
        'allowEscapeKey': false,
        'text': "Lo sentimos su licencia esta vencida",
        'showConfirmButton': false
      });
      desactivarComponentes();
    } else {
      if (_0x24f98b[0x0].valor == 0x1) {
        Swal.fire({
          'icon': "error",
          'title': "Licencia",
          'allowOutsideClick': false,
          'allowEscapeKey': false,
          'text': "Lo sentimos su licencia esta vencida",
          'showConfirmButton': false
        });
        desactivarComponentes();
      }
      if (_0x24f98b[0x0].valor == 0x2) {
        Swal.fire({
          'icon': "error",
          'title': "Error de encriptacion",
          'allowOutsideClick': false,
          'allowEscapeKey': false,
          'text': "Se detectó un cambio en el sistema, por su seguridad se ha bloqueado. Comuníquese con el administrador del sistema.",
          'showConfirmButton': false
        });
        desactivarComponentes();
      }
      activarComponentes();
    }
  }, 0x7d0)["catch"](_0x19fb8e => {
    activarComponentes();
    if (fecha > localStorage.getItem("date")) {
      Swal.fire({
        'icon': 'error',
        'title': "Licencia",
        'allowOutsideClick': false,
        'allowEscapeKey': false,
        'text': "Lo sentimos su licencia esta vencida",
        'showConfirmButton': false
      });
      desactivarComponentes();
    }
  });
}
function activarComponentes() {
  if (document.getElementById("btn-login") !== undefined && document.getElementById("btn-login") !== null) {
    document.getElementById('btn-login').disabled = false;
  }
  if (document.getElementById('typeEmailX') !== undefined && document.getElementById("typeEmailX") !== null) {
    document.getElementById('typeEmailX').disabled = false;
  }
  if (document.getElementById("typePasswordX") !== undefined && document.getElementById("typePasswordX") !== null) {
    document.getElementById("typePasswordX").disabled = false;
  }
  $("#ali").css("cursor", '');
  $("#ali").css("pointer-events", '');
  $("#fre").css("cursor", '');
  $("#fre").css("pointer-events", '');
  $("#frem").css("cursor", '');
  $("#frem").css('pointer-events', '');
  $("#sus").css('cursor', '');
  $("#sus").css("pointer-events", '');
  $("#opac").css("cursor", '');
  $("#opac").css("pointer-events", '');
  $("#gase").css("cursor", '');
  $('#gase').css("pointer-events", '');
  $("#gasem").css("cursor", '');
  $("#gasem").css("pointer-events", '');
  $('#lux').css("cursor", '');
  $('#lux').css("pointer-events", '');
  $("#luxm").css("cursor", '');
  $("#luxm").css("pointer-events", '');
  $('#son').css('cursor', '');
  $("#son").css("pointer-events", '');
}
function desactivarComponentes() {
  if (document.getElementById("btn-login") !== undefined && document.getElementById("btn-login") !== null) {
    document.getElementById("btn-login").disabled = true;
  }
  if (document.getElementById("typeEmailX") !== undefined && document.getElementById("typeEmailX") !== null) {
    document.getElementById('typeEmailX').disabled = true;
  }
  if (document.getElementById("typePasswordX") !== undefined && document.getElementById("typePasswordX") !== null) {
    document.getElementById("typePasswordX").disabled = true;
  }
  $("#ali").css("cursor", "not-allowed");
  $('#ali').css("pointer-events", "none");
  $("#fre").css('cursor', 'not-allowed');
  $("#fre").css("pointer-events", 'none');
  $("#frem").css("cursor", "not-allowed");
  $("#frem").css("pointer-events", "none");
  $("#sus").css("cursor", 'not-allowed');
  $("#sus").css('pointer-events', "none");
  $('#opac').css("cursor", "not-allowed");
  $("#opac").css('pointer-events', "none");
  $("#gase").css('cursor', "not-allowed");
  $("#gase").css("pointer-events", 'none');
  $('#gasem').css("cursor", 'not-allowed');
  $('#gasem').css("pointer-events", "none");
  $("#lux").css('cursor', "not-allowed");
  $("#lux").css("pointer-events", "none");
  $("#luxm").css('cursor', 'not-allowed');
  $("#luxm").css('pointer-events', "none");
  $("#son").css("cursor", "not-allowed");
  $('#son').css("pointer-events", "none");
}

$("#formLogin").on("submit", function (event) {
  event.preventDefault(); // Prevent the default form submission

  var formData = $(this).serializeArray(); // Serialize form data into an array
  var dataObject = {};

  // Convert the serialized array into an object
  formData.forEach(function (item) {
    dataObject[item.name] = item.value;
  });
  dataObject["dominio"] = dominio;

  $.ajax({
    url: 'https://appdataingeniersoftware.com/appdatacontrol/index.php/Cdispositivo/getLogin',
    type: 'post',
    dataType: 'json',
    data: {
      datos: dataObject,
    },
    success: function (response) {
      //console.log('Response:', response);
      if (response == 1) {
        getLogin();
      } else {
        Swal.fire({
          'icon': 'error',
          'title': "Error",
          'allowOutsideClick': false,
          'allowEscapeKey': false,
          'showConfirmButton': true,
          'text': "Usuario o contraseña incorrectos.",
        });
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      //console.log('Error:', textStatus, errorThrown);
    }
  });

 // console.log("Captured Form Data:", dataObject);

  // You can now use `dataObject` for further processing
});

var getLogin = function () {
  $.ajax({
    url: 'index.php/getSession/',
    type: 'get',
    dataType: 'json',
    data: {
      _token: $("input[name='_token']").val()
    },
    success: function (data, textStatus, jqXHR) {
     // console.log('Response:', data);
      window.location.href = "index.php/cpr";

    },

  });
}