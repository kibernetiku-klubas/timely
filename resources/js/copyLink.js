document.getElementById("copyLink").addEventListener("click", function () {
    const meetingId = this.getAttribute('data-meeting-id');
    const meetingLink = `https://timely.lt/meetings/${meetingId}`;

    navigator.clipboard.writeText(meetingLink)
        .then(() => console.log('Text copied to clipboard'))
        .catch(err => console.log('Failed to copy text: ', err));

    let linkElement = document.getElementById("link");
    linkElement.innerText = "Link copied!";

    setTimeout(function () {
        linkElement.innerText = meetingLink;
    }, 2250);
});
