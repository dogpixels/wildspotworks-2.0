async function getData() {
  try {
    const response = await fetch(`js/gallery-data.json`);
    if (!response.ok) {
      throw new Error(`Response status: ${response.status}`);
    }
    const jsonData = await response.json();
    for (
      let gallery_item = 0;
      gallery_item < jsonData.contents.length;
      gallery_item++
    ) {
      let entry = document.createElement("gallery-entry");
      entry.setAttribute("id", `e${gallery_item}`);
      entry.setAttribute("class", `entry`);
      document.getElementById("gallery-list").appendChild(entry);
      let button = document.createElement("button");
      button.setAttribute("id", `b${gallery_item}`);
      button.setAttribute("class", `entry-button`);
      entry.appendChild(button);
      document.getElementById(`b${gallery_item}`).innerText =
        jsonData.contents[gallery_item].title;
    }
  } catch (error) {
    console.error(error.message);
  }
}
getData();
