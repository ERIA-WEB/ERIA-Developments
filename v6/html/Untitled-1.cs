public void OnMappedColumnCellChanged(string newValue, DataGrid grid, DataGridCellEditEndingEventArgs e)
		{
			if (!IsAtCellEditEnding)
			{
				try
				{
					IsAtCellEditEnding = true;

					var headerText = SelectedColumn?.Header?.ToString();

					if (!string.IsNullOrEmpty(headerText))
					{
						int columnIndexNum;
						var isHeaderNotSet = string.IsNullOrEmpty(headerText) || Int32.TryParse(headerText, out columnIndexNum);

						if (isHeaderNotSet)
						{
							// NOTE: Let's not handle column-highlight scenario for now.
						}
						else
						{
							DoorTemplateStructure headerStruct = null;
							string originalHeaderId = null;

							if (true == ColumnNewOldHeadersMap.TryGetValue(headerText, out originalHeaderId))
							{
								if (false == ColumnOldNewFieldMaps.TryGetValue(originalHeaderId, out headerStruct))
								{
									headerStruct = ProjectDoorStructure.FirstOrDefault(s => s.Header == headerText);
								}
							}

							if (headerStruct != null)
							{
								if (headerStruct.FieldName == "DoorQty")
								{
									var text = newValue;

									if (text != null)
									{
										int tmp;

										if (int.TryParse(text, out tmp))
										{
											// OK
										}
										else
										{
											e.Cancel = true;
											grid.CancelEdit(DataGridEditingUnit.Cell);
											ShowWarning(AppStrings.ExelImporterMappedColumnChangeUndone, AppStrings.ExcelImportHardwareQty_ContentNeeded_ErrorMessage);
										}
									}
									else
									{
										e.Cancel = true;
										grid.CancelEdit(DataGridEditingUnit.Cell);
										ShowWarning(AppStrings.ExelImporterMappedColumnChangeUndone, AppStrings.ExcelImportHardwareQty_ContentNeeded_ErrorMessage);
									}
								}
								else if (headerStruct.FieldName == "DoorNo")
								{
									var rowObjectAsDynamic = grid.CurrentCell.Item as dynamic;
									
									if (rowObjectAsDynamic[originalHeaderId] != newValue)
									{
										IsMappedDoorNrColumnDirty = true;
									}

									//////TODO: If door nr exists, undo the change

									////// NOTE: The new value must be set in the excel-door object; otherwise it won't be recognised by the validation logic
									////var rowObjectAsDynamic = grid.CurrentCell.Item as dynamic;
									////////rowObj
									//////TODO: Set prop with new val
									////rowObjectAsDynamic[originalHeaderId] = newValue;
									////////EventAtCellEditEnding = e;
									////////var propertyInfo = rowObj.GetType().GetProperty(originalHeaderId);
									////////propertyInfo.SetValue(rowObj, newValue);
									////////ExcelDataGrid.CommitEdit();

									////UnsetColumnHeader(SelectedColumn);
									////SetColumnHeaderWrapper(headerStruct);

									////// NOTE: For now, undoing every change when header is set vvv

									////////e.Cancel = true;
									////////grid.CancelEdit(DataGridEditingUnit.Cell);
									////////ShowWarning(AppStrings.ExelImporterMappedColumnChangeUndone, AppStrings.ExcelImporterDoorNumberCantBeChangedWhenMapped);
								}
								else if (headerStruct.FieldName.Contains("Qty"))
								{
									var text = newValue;

									if (text != null)
									{
										int tmp;

										if (int.TryParse(text, out tmp))
										{
											// OK
										}
										else
										{
											e.Cancel = true;
											grid.CancelEdit(DataGridEditingUnit.Cell);
											ShowWarning(AppStrings.ExelImporterMappedColumnChangeUndone, AppStrings.ExcelImportHardwareQty_ContentNeeded_ErrorMessage);
										}
									}
									else
									{
										e.Cancel = true;
										grid.CancelEdit(DataGridEditingUnit.Cell);
										ShowWarning(AppStrings.ExelImporterMappedColumnChangeUndone, AppStrings.ExcelImportHardwareQty_ContentNeeded_ErrorMessage);
									}
								}
							}
						}
					}
				}
				finally
				{
					IsAtCellEditEnding = false;
				}
			}