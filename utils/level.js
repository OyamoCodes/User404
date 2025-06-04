export class Level{
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