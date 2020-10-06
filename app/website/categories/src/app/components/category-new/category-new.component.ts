import { Component, OnInit } from '@angular/core';
import { CategoryService } from 'src/app/shared/category.service';
import { Router } from '@angular/router';
import { FormBuilder, FormGroup, FormControl, Validators } from '@angular/forms';

@Component({
  selector: 'app-category-new',
  templateUrl: './category-new.component.html',
  styleUrls: ['./category-new.component.css']
})
export class CategoryNewComponent implements OnInit {

  name: string;
  submitted = false;
  categoryForm: FormGroup;

  constructor(
    public categoryService: CategoryService,
    private router: Router,
    public fb: FormBuilder,
  ) {
  }

  ngOnInit(): void {
    this.categoryForm = this.fb.group({
      name: new FormControl('', [Validators.required, Validators.minLength(3), Validators.maxLength(20)]),
    })
  }

  submitForm() {
    this.createCategory();
  }

  createCategory() {
    this.categoryService.Create(this.categoryForm.value.name).subscribe(data => {
      this.submitted = true;
      this.gotoList();
    },
    error => console.log(error));
  }

  gotoList() {
    this.router.navigate(['/']);
  }

}
