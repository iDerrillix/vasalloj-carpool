function toggleModal(heading, paragraph) {
    const header2 = document.querySelector("#modal h2");
    const paragraphElement = document.querySelector("#modal p");
    
    if (heading && paragraph) {
      header2.innerHTML = heading;
      paragraphElement.innerHTML = paragraph;
    }
  
    const bodyClassList = document.body.classList;
    if (bodyClassList.contains("open")) {
      bodyClassList.remove("open");
      bodyClassList.add("closed");
    } else {
      bodyClassList.remove("closed");
      bodyClassList.add("open");
    }
  }