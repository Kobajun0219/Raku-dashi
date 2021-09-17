var input = document.getElementById('input-custom-dropdown'),
    // init Tagify script on the above inputs
    tagify = new Tagify(input, {
      whitelist: ["#ポリエステル100%", "#コットン100%", "#婦人服のみ", "#衣類品", "#スポーツウェア", "#衣料品全般 (下着を除く)", "#タオル・シーツ・カバー類", "#スーツ・スラックス・カジュアルシャツ・カジパン", "#きもの", "#繊維製品","#雑貨","#シャツ"],
      maxTags: 10,
      dropdown: {
        maxItems: 20,           // <- mixumum allowed rendered suggestions
        classname: "tags-look", // <- custom classname for this dropdown, so it could be targeted
        enabled: 0,             // <- show suggestions on focus
        closeOnSelect: false    // <- do not hide the suggestions dropdown once an item has been selected
      }
    })