import { Component, OnInit } from '@angular/core';
import { CategoryModel } from 'src/app/models/category.model';
import { switchMap } from "rxjs/operators";
import { ActivatedRoute } from '@angular/router';
import { AppSettings } from 'src/app/app.settings';
import { Functions } from 'src/app/common/functions';
import { CategoryService } from 'src/app/providers/category.service';

declare var $:any;
@Component({
  selector: 'app-category-edit',
  templateUrl: './category-edit.component.html',
  styleUrls: ['./category-edit.component.css']
})
export class CategoryEditComponent implements OnInit {

  category: CategoryModel;
  isBusy = false;
  constructor(
    private categoryService: CategoryService, 
    private functions: Functions, 
    private route: ActivatedRoute, 
    private appService: AppSettings
  ) {
    this.init();
  }

  private init() {
    this.category = new CategoryModel(0, '', '', '', null, null, null, true);
    if(this.functions.defaultContent)
    $('#image').val('');
    $('#preview').html(this.functions.defaultContent);
  }

  ngOnInit() {
    this.route.paramMap.subscribe(params => {
      this.category.id = Number(params.get("id"))
    });
    if (!this.category.id)
      this.appService.setTitlePage('Création d\'une catégorie');
    else
      this.appService.setTitlePage('Edition d\'une catégorie');

    // this.category = this.route.paramMap.pipe(
    //   switchMap(params => {
    //     const id = +params.get("id")
    //     return this.service.getData(id) // http request
    //   })
    // )
  }
  uploadFile(event) {
    this.category.image = event.target.files[0] ? event.target.files[0] : null;
    this.functions.readURL(document.getElementById('image'), 
    $('#preview'), 2 * 1024, 
    $('#preview').width() - 10, 
    $('#preview').height() - 10)
  }

  save(form) {
    this.isBusy = true;
    this.categoryService.add(this.category);
    this.isBusy = false;
    this.init();
    $('.toast').toast('show');
  }
}
