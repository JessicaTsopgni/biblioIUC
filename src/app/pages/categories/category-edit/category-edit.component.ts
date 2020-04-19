import { Component, OnInit } from '@angular/core';
import { CategoryModel } from 'src/app/models/category.model';
import { switchMap } from "rxjs/operators";
import { ActivatedRoute } from '@angular/router';
import { AppSettings } from 'src/app/app.settings';
import { Functions } from 'src/app/common/functions';
import { CategoryService } from 'src/app/providers/category.service';

declare var $: any;
@Component({
  selector: 'app-category-edit',
  templateUrl: './category-edit.component.html',
  styleUrls: ['./category-edit.component.css']
})
export class CategoryEditComponent implements OnInit {

  category: CategoryModel;
  isBusy = false;
  appName = '';
  responseMessage = '';
  responseTime = '';
  errors = null;
  constructor(
    private categoryService: CategoryService,
    private functions: Functions,
    private route: ActivatedRoute,
    private appSettings: AppSettings
  ) {
    this.init();
    this.appName = this.appSettings.appName;
  }

  private init() {
    this.category = new CategoryModel(0, '', '', '', null, null, null, true);
    if (this.functions.defaultContent) {
      $('#image').val('');
      $('#preview').html(this.functions.defaultContent);
    }
  }

  ngOnInit() {
    this.route.paramMap.subscribe(params => {
      this.category.id = Number(params.get("id"))
    });
    if (!this.category.id)
      this.appSettings.setTitlePage('Création d\'une catégorie');
    else
      this.appSettings.setTitlePage('Edition d\'une catégorie');

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

  save(myForm) {
    let startTime = performance.now();
    this.categoryService.add(this.category)
      .subscribe(
        data => {
          this.errors = null;
          let category = <CategoryModel>data.response_data;
          this.responseMessage = category.name + " enregistré avec succès.";
        },
        error => {
          this.errors = error.error.response_data;
        }
      );
    myForm.form.markAsPristine();
    myForm.form.markAsUntouched();
    myForm.form.updateValueAndValidity();
    this.init();
    var endTime = performance.now();
    this.responseTime = this.functions.get_time_diff_sec(startTime, endTime);
    this.isBusy = false;
    $('.toast').toast('show');
  }
}
