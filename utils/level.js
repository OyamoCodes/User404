export class Level{
    drawMapLayout(levelLayout, mappings){
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
            scale()
        ]);
    }
}