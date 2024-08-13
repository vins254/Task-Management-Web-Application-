/**document.querySelector("#show_task").addEventListener("click", function(){
    document.querySelector(".wrapper").classList.add("active");

});
document.querySelector(".wrapper .close_btn").addEventListener("click",function(){
    document.querySelector(".wrapper").classList.remove("active");
});**/


var show_task = document.querySelector("#show-task");
var wrapper = document.querySelector(".wrapper");
var close_btn = document.querySelector(".close-btn");
show_task.onclick = function () {
    wrapper.classList.add("active");
}
close_btn.addEventListener("click", () => {
    wrapper.classList.remove("active");
})