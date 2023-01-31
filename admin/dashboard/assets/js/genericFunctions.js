const getEndpoint = () => {
  return "http://localhost:8080";
};

const getTokenBearer = () => {
  return `Bearer ${localStorage.getItem("token")}`;
};

const getIdByUrl = () => {
  var url = window.location.href;
  return url.split("?")[1].split("=")[1];
};

const numberToReal = () => {
  if (!number) return false;
  var number = Number(number).toFixed(2).split(".");
  number[0] = "R$ " + number[0].split(/(?=(?:...)*$)/).join(".");
  return number.join(",");
};

const formatMoneyToCallTheApi = (value) => {
  if (value) {
    return value.replace(",", "");
  }
};
