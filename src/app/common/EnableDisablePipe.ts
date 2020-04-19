import {Pipe, PipeTransform} from '@angular/core';

@Pipe({name: 'enableDisable'})
export class EnableDisablePipe implements PipeTransform {
    transform(value) {
        return value ? 'Activé' : 'Désactivé';
    }
}