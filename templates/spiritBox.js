function spiritBox(id, name, series) {
    res = `
    <div class='spiritBox'>
    <a href="details.php?id=${id}">
        <div class="upperBox">
            <img src="img/seriesIcons/${series}.png" `;
    switch(series) {
        case "Other":
            res = res + ` class="other"`;
            break;
        case "MetalGear":
            res = res + ` class="mgs" `;
            break;
    }
    res = res + ` /><div class="invisible"></div><p>${id}</p></div>
    <div class='spiritImgContainer'>
        <img src='img/spiritImages/${id}.png' alt='${name}' />
    </div>
    <div class='lowerBox'>
        <p> ${name} </p>
    </div>
    </a>
</div>
`;
return res;
}