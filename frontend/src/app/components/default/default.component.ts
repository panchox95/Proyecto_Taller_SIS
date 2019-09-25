import { Component, OnInit, Input} from '@angular/core';
import { Router, ActivatedRoute, Params} from '@angular/router';
import { User } from '../../models/user';
import { UserService } from '../../services/user.service';
import { error } from 'selenium-webdriver';

@Component({
    selector: 'app-default',
    templateUrl: './default.component.html',
    //styleUrls: ['./default.component.css'],
    providers: [UserService]
})
export class DefaultComponent implements OnInit {

    public title: string;

    constructor(
        private _route: ActivatedRoute,
        private _router: Router,
        private _userService: UserService
    ) {
        this.title='Inicio';

    }

    ngOnInit() {
        console.log('default.component cargado satisfactoriamente');
    }

    


}
