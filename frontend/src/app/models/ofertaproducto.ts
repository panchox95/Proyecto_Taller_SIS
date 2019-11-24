export class OfertaProducto {
    constructor(
        public id_oferta: number,
        public id_producto: number,
        public descripcion: string,
        public descuento: number,
        public imagepath: string
    ){}
}
