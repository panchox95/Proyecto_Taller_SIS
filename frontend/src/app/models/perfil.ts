import { User } from './user';
export class Perfil {
    constructor(
        //public id_user: number,
        public telefono: string,
        public direccion: string,
        public foto: string,
        public tarjeta: string,
      public zipcode: string,
      public user: User
    ){}
}
