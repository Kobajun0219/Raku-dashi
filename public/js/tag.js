var input = document.querySelector('input[name=tags]'),
    // init Tagify script on the above inputs
    tagify = new Tagify(input, {
        whitelist : ["A# .NET", "A# (Axiom)"],
        blacklist : ["react", "angular"]
    });

// "remove all tags" button event listener
// document.querySelector('.tags--removeAllBtn')
//     .addEventListener('click', tagify.removeAllTags.bind(tagify))

// Chainable event listeners
tagify.on('add', onAddTag)
      .on('remove', onRemoveTag)
      .on('invalid', onInvalidTag);

// tag added callback
function onAddTag(e){
    console.log(e, e.detail);
    console.log( tagify.DOM.originalInput.value )
    tagify.off('add', onAddTag) // exmaple of removing a custom Tagify event
}

// tag remvoed callback
function onRemoveTag(e){
    console.log(e, e.detail);
}

// invalid tag added callback
function onInvalidTag(e){
    console.log(e, e.detail);
}