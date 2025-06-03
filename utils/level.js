export class Level{
    drawHotbar(hour){
        let offset = -100;
        for (let i = 0; i < 10; i++) {
            add([sprite("test", {anim}),
                pos(center().x + offset, center().y + 200),
                area(),
                anchor("center"),
                color(0, 0, 0),
            ]);
            offset += 20;
        }
    }
    drawMapLayout(levelLayout, mappings){
        const layerSettings = {
            tileWidth:16, 
            tileHeight:12,
            tiles: mappings,
        }
        this.map = []
        for(const layerLayout of levelLayout){
            this.map.push(addLevel(layerLayout, layerSettings));
        }
        for (const layer of this.map){
            layer.use()
        }
    }
    drawBackground(sky_bg) {
        add([
            sprite("sky_bg"),
            fixed(),
            scale(2)
        ]);
    }
}