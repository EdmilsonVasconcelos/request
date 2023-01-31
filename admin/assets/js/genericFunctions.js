const getEndpoint = () => {
  return "http://localhost:8080";
};

const getTokenBearer = () => {
  return localStorage.getItem("token");
};
