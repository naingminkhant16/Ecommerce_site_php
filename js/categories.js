const button = document.getElementsByTagName('button');
for (let i = 0; i < button.length; i++) {
  button[i].addEventListener('click', function(e) {
    const img = this.previousElementSibling.previousElementSibling.cloneNode(true)
    img.classList.add('zoom')
    document.querySelector('body').appendChild(img);

    setTimeout(function() {
      document.querySelector('.zoom').remove()
    }, 1000)
  })
}