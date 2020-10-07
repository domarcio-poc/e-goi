import { Component, OnInit } from '@angular/core';
import { CategoryService } from 'src/app/shared/category.service';
import { Category } from 'src/app/shared/category';

@Component({
  selector: 'app-category-list',
  templateUrl: './category-list.component.html',
  styleUrls: ['./category-list.component.css']
})
export class CategoryListComponent implements OnInit {
  offset         = 1;
  pageSize       = 5;
  collectionSize = 10;
  filterName     = '';
  hasError       = false;

  CategoriesList: Category[];
  newCategoryName: string;
  errorMessage: string;

  constructor(
    public categoryService: CategoryService
  ) { }

  ngOnInit(): void {
    this.loadCategories();
  }

  updateCategory(id: number, name: string) {
    return this.categoryService.Update(id, name)
      .subscribe(
        data => {
          this.loadCategories();
        },
        error => {
          this.errorMessage = error.error.message;
          this.hasError = true;
        }
      );
  }

  removeCategory(id: number) {
    return this.categoryService.Delete(id)
      .subscribe(
        data => {
          this.loadCategories();
        },
        error => {
          this.errorMessage = error;
          this.hasError = true;
        }
      );
  }

  loadCategories() {
    return this.categoryService.GetList(this.offset, this.filterName).subscribe((data:any) => {
        this.CategoriesList = data.categories;
        delete data.categories;

        this.pageSize = data.limit;
        this.collectionSize = data.total;
    })
  }

}
