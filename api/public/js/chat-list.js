/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***********************************!*\
  !*** ./resources/js/chat-list.js ***!
  \***********************************/
$(document).ready(function () {
  function validateRoomName() {
    var isValid = true;
    var roomNameInput = $('#room-name');
    var roomNameErrorSpan = $('#room-name-error');

    if (roomNameInput.val() === '') {
      roomNameInput.addClass('border-red-500');
      roomNameErrorSpan.html('Room name can\'t be empty!');
      isValid = false;
    } else if (roomNameInput.hasClass('border-red-500')) {
      roomNameInput.removeClass('border-red-500');
      roomNameErrorSpan.html('');
    }

    return isValid;
  }

  function createRoom() {
    var isRoomNameValid = validateRoomName();

    if (isRoomNameValid) {
      window.axios.post('/chat/room/create', {
        name: $('#room-name').val()
      }).then(function (response) {
        window.location = '/chats/room/' + response.data.id;
      })["catch"](function (error) {
        //TODO show errors
        console.log(error);
      });
    }
  }

  $('#create-room-btn').on('click', function () {
    createRoom();
  });
  $('#room-name').on('input', function () {
    validateRoomName();
  });
});
/******/ })()
;