document.addEventListener("DOMContentLoaded", () => {
  const element = document.querySelector(".alerta");
  const table = document.querySelector("#table_id");

  if (element && table) {
    setTimeout(() => {
      element.parentElement.parentElement.parentElement.parentElement.parentElement.remove();
    }, 4000);
  } else if (element) {
    setTimeout(() => {
      element.remove();
    }, 4000);
  }
});
