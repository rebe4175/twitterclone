function validateForm() {

    const username = document.forms["signUpForm"]["email"].value;
    const password = document.forms["signUpForm"]["password"].value;

    if (username == "") {
        console.log("Email must be filled out");
        return false;
    }

    if (password == "") {
        console.log("Password must be filled out");
        return false;
    }
}

function showPage(pageId) {
    console.log('showing page...', pageId)
    // <div id="home" class="subpage">page home</div>
    document.querySelectorAll('.subpage').forEach(item => {
        item.style.display = "none"
    })
    document.getElementById(pageId).style.display = "grid"
}



var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

btn.onclick = function () {
    modal.style.display = "block";
}


// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

let logInBtn = document.querySelector("#logInBtn");

var logOutBtn = document.querySelector(".logout");

logOutBtn.onclick = function () {

    window.location.href = "logout.php";
}
// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

function tweet() {

    console.log("tweeting");
    getTweets();

}

var latestReceivedTweetId = 0 // 47

async function getTweets() {

    document.querySelector("#tweetsProfile").innerHTML = "";
    document.querySelector("#tweets").innerHTML = "";

    // let request = await fetch('api-get-tweet.php?user=${userId}&id=${tweetId}');
    let request = await fetch('api-get-tweet.php');
    let sResponse = await request.text();
    let jResponse = JSON.parse(sResponse);
    console.log(jResponse);

    let aUserTweets = jResponse;

    // console.log(jResponse);

    if (request.status != 200) {
        console.log('error');
        return;
    }

    let i;
    for (i = 0; i < aUserTweets.length; i++) {
        // console.log(aUserTweets[i]);
        // console.log(aUserTweets[i].id);
        // console.log(aUserTweets[i].author);
        // <button onclick='updateTweet("${aUserTweets[i].id}")'>update</button>

        let divTweet = `
      <div id="tweetWrapper" class="tweet">
        <p><strong>${aUserTweets[i].author}</strong>@${aUserTweets[i].author}</p>
        <p>${aUserTweets[i].message}</p>
      </div>`

        document.querySelector("#tweets").insertAdjacentHTML('afterbegin', divTweet);

        let divTweetProfile = `
        <div class="tweetProfile" id="${aUserTweets[i].id}">
          <p>${aUserTweets[i].message}</p>
          <button onclick='deleteTweet("${aUserTweets[i].id}")'>delete</button>
          <button onclick='updateTweet("${aUserTweets[i].id}")'>update</button>
        </div>`

        document.querySelector("#tweetsProfile").insertAdjacentHTML('afterbegin', divTweetProfile);

    }

}


function deleteTweet(tweetId) {
    console.log("Tweet delete clicked" + tweetId);
    //
    window.location = "api-delete-tweet.php?tweetId=" + tweetId;

}

function updateTweet(tweetId) {

    console.log("hello")

    let modalUpdateForm = `
        <div id="modalFormContainer">
        <div class="modal-data">
          
          <form class="modal-data" action="api-update-tweet.php?tweetId=${tweetId}" method="POST">
          <div class="form-heading"><div class="x-btn red-btn"></div></div>
                    <label>Update Tweet</label><input name="newTweetTitle" type="text" placeholder="Enter new message here...." data-type="string">
                    <button class="modal-btn" type="submit">UPDATE</button> 
          </form>
          </div>
        </div>
        `

    document.querySelector('body').innerHTML += modalUpdateForm;
}


