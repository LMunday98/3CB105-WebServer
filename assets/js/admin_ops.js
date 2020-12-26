function edit_users(id) {
  console.log("edit", id);

  change_dispaly("user_table", "none");
  change_dispaly("edit_section", "inline");
}

function change_dispaly(class_name, show_type) {
  var divsToHide = document.getElementsByClassName(class_name); //divsToHide is an array
  for(var i = 0; i < divsToHide.length; i++){
      divsToHide[i].style.display = show_type; // depending on what you're doing
  }
}
