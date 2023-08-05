splash = null
if (window.localStorage.getItem("splash")) {
    splash = window.localStorage.getItem("splash")
} else {
    window.localStorage.setItem("splash", JSON.stringify({ 'see': 0 }))
}

$(document).ready(function () {
    countSplash = JSON.parse(splash).see + 1
    window.localStorage.setItem("splash", JSON.stringify({ 'see': countSplash }))

    $("#linkDashboard").css('pointer-events', 'none')
    $("#linkDashboard").addClass('bg-gradient-to-tr from-green-600 to-green-400 text-white py-1')
    $('#linkDashboardBar').hide()

    $('#signIn').hide()
    $('#signInBar').hide()
})


