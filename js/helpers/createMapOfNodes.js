export function createMapOfNodes(name) {

    let map = new Map(),
        array = document.querySelectorAll('.inputText');
    array.forEach(e => {
        map.set(e.name, e);
    });
    return map;
}