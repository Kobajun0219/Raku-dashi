// var input = document.querySelector('input[name=tags]'),
//     // init Tagify script on the above inputs
//     tagify = new Tagify(input, {
//         whitelist : ["A# .NET", "A# (Axiom)"],
//         blacklist : ["react", "angular"]
//     });

// // "remove all tags" button event listener
// // document.querySelector('.tags--removeAllBtn')
// //     .addEventListener('click', tagify.removeAllTags.bind(tagify))

// // Chainable event listeners
// tagify.on('add', onAddTag)
//       .on('remove', onRemoveTag)
//       .on('invalid', onInvalidTag);

// // tag added callback
// function onAddTag(e){
//     console.log(e, e.detail);
//     console.log( tagify.DOM.originalInput.value )
//     tagify.off('add', onAddTag) // exmaple of removing a custom Tagify event
// }

// // tag remvoed callback
// function onRemoveTag(e){
//     console.log(e, e.detail);
// }

// // invalid tag added callback
// function onInvalidTag(e){
//     console.log(e, e.detail);
// }


var input = document.getElementById('input-custom-dropdown'),
    // init Tagify script on the above inputs
    tagify = new Tagify(input, {
      whitelist: ["#ポリエステル100%", "#コットン100%", "#婦人服のみ", "#衣類品", "#スポーツウェア", "#衣料品全般 (下着を除く)", "#タオル・シーツ・カバー類", "#スーツ・スラックス・カジュアルシャツ・カジパン", "#きもの", "#繊維製品", "#ACC"],
      maxTags: 10,
      dropdown: {
        maxItems: 20,           // <- mixumum allowed rendered suggestions
        classname: "tags-look", // <- custom classname for this dropdown, so it could be targeted
        enabled: 0,             // <- show suggestions on focus
        closeOnSelect: false    // <- do not hide the suggestions dropdown once an item has been selected
      }
    })