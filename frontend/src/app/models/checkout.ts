export class Checkout {
  constructor(
    public id: string ,
    public cvc: string,
    public exp_month: number ,
    public exp_year: number,
    public name: string,
  ){}
}
