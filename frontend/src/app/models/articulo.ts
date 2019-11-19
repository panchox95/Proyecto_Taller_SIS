export class Articulo {
    constructor(
        public id_producto: number,
        public nombre: string,
        public marca: string,
        public cantidad: number,
        public categoria: number,
        public precio: number,
        public descripcion: string,
        public estado: string,

    ){}
}
