splash = null
if (window.localStorage.getItem("splash")) {
    splash = window.localStorage.getItem("splash")
} else {
    window.localStorage.setItem("splash", JSON.stringify({ 'see': 0 }))
}

$(document).ready(function () {
    // countSplash = JSON.parse(splash).see + 1
    // window.localStorage.setItem("splash", JSON.stringify({ 'see': countSplash }))
})


