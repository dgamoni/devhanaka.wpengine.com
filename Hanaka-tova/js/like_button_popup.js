function addTitleProductButtons(className, titleText) {
    var likeButton = document.getElementsByClassName(className);
    var i = 0;
    for (i = 0; i < likeButton.length; i++) {  
    var att = document.createAttribute("title");
    att.value = titleText;
    likeButton[i].setAttributeNode(att);
    }
}
addTitleProductButtons('add_to_wishlist', 'רשימת משאלות');
addTitleProductButtons('compare', 'להשוואה');