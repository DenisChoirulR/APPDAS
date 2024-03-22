<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Commissioner
 *
 * @property string $id
 * @property string $company_id
 * @property string $name
 * @property string|null $position
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Commissioner newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Commissioner newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Commissioner query()
 * @method static \Illuminate\Database\Eloquent\Builder|Commissioner whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Commissioner whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Commissioner whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Commissioner whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Commissioner wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Commissioner whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class IdeHelperCommissioner {}
}

namespace App\Models{
/**
 * App\Models\Company
 *
 * @property string $id
 * @property string|null $company_status_id
 * @property string $code
 * @property string $name
 * @property string $address
 * @property string $phone
 * @property string|null $secondary_phone
 * @property string|null $email
 * @property string|null $deed_of_incorporation
 * @property string|null $file_deed_of_incorporation
 * @property \App\Models\CompanyStatus|null $company_status
 * @property string|null $tax_identification_number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Commissioner> $commissioners
 * @property-read int|null $commissioners_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DeedOfAmendment> $deed_amendments
 * @property-read int|null $deed_amendments_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Director> $directors
 * @property-read int|null $directors_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Ippkh> $ippkh
 * @property-read int|null $ippkh_count
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SharePercentage> $share_percentages
 * @property-read int|null $share_percentages_count
 * @method static \Illuminate\Database\Eloquent\Builder|Company newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Company newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Company onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Company query()
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereCompanyStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereCompanyStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereDeedOfIncorporation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereFileDeedOfIncorporation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereSecondaryPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereTaxIdentificationNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Company withoutTrashed()
 * @mixin \Eloquent
 */
	class IdeHelperCompany {}
}

namespace App\Models{
/**
 * App\Models\CompanyStatus
 *
 * @property string $id
 * @property string $status
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Company> $companies
 * @property-read int|null $companies_count
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyStatus whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyStatus whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyStatus whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyStatus whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class IdeHelperCompanyStatus {}
}

namespace App\Models{
/**
 * App\Models\Contractor
 *
 * @property string $id
 * @property string|null $company_status_id
 * @property string $code
 * @property string $company_name
 * @property string $address
 * @property string $phone
 * @property string $email
 * @property string $deed_of_incorporation
 * @property string|null $file_deed_of_incorporation
 * @property string $company_registration_number
 * @property string|null $file_company_registration_number
 * @property string $director
 * @property string|null $company_type
 * @property string|null $work_area
 * @property string|null $tax_identification_number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\CompanyStatus|null $companyStatus
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CooperativeContract> $contracts
 * @property-read int|null $contracts_count
 * @method static \Illuminate\Database\Eloquent\Builder|Contractor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contractor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contractor onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Contractor query()
 * @method static \Illuminate\Database\Eloquent\Builder|Contractor whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contractor whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contractor whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contractor whereCompanyRegistrationNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contractor whereCompanyStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contractor whereCompanyType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contractor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contractor whereDeedOfIncorporation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contractor whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contractor whereDirector($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contractor whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contractor whereFileCompanyRegistrationNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contractor whereFileDeedOfIncorporation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contractor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contractor wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contractor whereTaxIdentificationNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contractor whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contractor whereWorkArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contractor withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Contractor withoutTrashed()
 * @mixin \Eloquent
 */
	class IdeHelperContractor {}
}

namespace App\Models{
/**
 * App\Models\CooperativeContract
 *
 * @property string $id
 * @property string|null $company_id
 * @property string $contractor_id
 * @property string $contract_number
 * @property \Illuminate\Support\Carbon $contract_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Company|null $company
 * @property-read \App\Models\Contractor $contractor
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\WorkOrder> $workOrders
 * @property-read int|null $work_orders_count
 * @method static \Illuminate\Database\Eloquent\Builder|CooperativeContract newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CooperativeContract newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CooperativeContract onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CooperativeContract query()
 * @method static \Illuminate\Database\Eloquent\Builder|CooperativeContract whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CooperativeContract whereContractDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CooperativeContract whereContractNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CooperativeContract whereContractorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CooperativeContract whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CooperativeContract whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CooperativeContract whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CooperativeContract whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CooperativeContract withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CooperativeContract withoutTrashed()
 * @mixin \Eloquent
 */
	class IdeHelperCooperativeContract {}
}

namespace App\Models{
/**
 * App\Models\DasLocation
 *
 * @property string $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|DasLocation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DasLocation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DasLocation onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|DasLocation query()
 * @method static \Illuminate\Database\Eloquent\Builder|DasLocation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DasLocation whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DasLocation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DasLocation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DasLocation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DasLocation withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|DasLocation withoutTrashed()
 * @mixin \Eloquent
 */
	class IdeHelperDasLocation {}
}

namespace App\Models{
/**
 * App\Models\DasProject
 *
 * @property string $id
 * @property string $company_id
 * @property string $das_location_id
 * @property string $code
 * @property string $sk_number
 * @property string $issue_date
 * @property string $area_size
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Company $company
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Ippkh> $ippkh
 * @property-read int|null $ippkh_count
 * @property-read \App\Models\DasLocation $location
 * @method static \Illuminate\Database\Eloquent\Builder|DasProject newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DasProject newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DasProject onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|DasProject query()
 * @method static \Illuminate\Database\Eloquent\Builder|DasProject whereAreaSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DasProject whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DasProject whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DasProject whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DasProject whereDasLocationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DasProject whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DasProject whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DasProject whereIssueDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DasProject whereSkNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DasProject whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DasProject withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|DasProject withoutTrashed()
 * @mixin \Eloquent
 */
	class IdeHelperDasProject {}
}

namespace App\Models{
/**
 * App\Models\DeedOfAmendment
 *
 * @property string $id
 * @property string $company_id
 * @property string $information
 * @property string|null $file
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|DeedOfAmendment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeedOfAmendment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeedOfAmendment query()
 * @method static \Illuminate\Database\Eloquent\Builder|DeedOfAmendment whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeedOfAmendment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeedOfAmendment whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeedOfAmendment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeedOfAmendment whereInformation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeedOfAmendment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class IdeHelperDeedOfAmendment {}
}

namespace App\Models{
/**
 * App\Models\Director
 *
 * @property string $id
 * @property string $company_id
 * @property string $name
 * @property string|null $position
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Director newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Director newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Director query()
 * @method static \Illuminate\Database\Eloquent\Builder|Director whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Director whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Director whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Director whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Director wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Director whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class IdeHelperDirector {}
}

namespace App\Models{
/**
 * App\Models\Ippkh
 *
 * @property string $id
 * @property string $company_id
 * @property string $ippkh_license_number
 * @property string $issue_date
 * @property string $area_size
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Company $company
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DasProject> $dasProjects
 * @property-read int|null $das_projects_count
 * @method static \Illuminate\Database\Eloquent\Builder|Ippkh newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ippkh newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ippkh onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Ippkh query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ippkh whereAreaSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ippkh whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ippkh whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ippkh whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ippkh whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ippkh whereIppkhLicenseNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ippkh whereIssueDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ippkh whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ippkh withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Ippkh withoutTrashed()
 * @mixin \Eloquent
 */
	class IdeHelperIppkh {}
}

namespace App\Models{
/**
 * App\Models\Plant
 *
 * @property string $id
 * @property string $sub_technical_design_id
 * @property string $activity_category
 * @property string $plant_name
 * @property int $number_of_plant
 * @property int $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Plant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Plant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Plant query()
 * @method static \Illuminate\Database\Eloquent\Builder|Plant whereActivityCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plant whereNumberOfPlant($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plant wherePlantName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plant wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plant whereSubTechnicalDesignId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plant whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class IdeHelperPlant {}
}

namespace App\Models{
/**
 * App\Models\PlantingPattern
 *
 * @property string $id
 * @property string $pattern
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PlantingPattern newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlantingPattern newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlantingPattern query()
 * @method static \Illuminate\Database\Eloquent\Builder|PlantingPattern whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlantingPattern whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlantingPattern wherePattern($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlantingPattern whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class IdeHelperPlantingPattern {}
}

namespace App\Models{
/**
 * App\Models\Realization
 *
 * @property string $id
 * @property string $work_order_id
 * @property \App\Enums\ActivityGroupEnum $activity_category
 * @property int $realization_of_planting
 * @property \App\Enums\VerificationStatusEnum|null $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RealizationItem> $items
 * @property-read int|null $items_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Verification> $verifications
 * @property-read int|null $verifications_count
 * @property-read \App\Models\WorkOrder $work_order
 * @method static \Illuminate\Database\Eloquent\Builder|Realization newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Realization newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Realization query()
 * @method static \Illuminate\Database\Eloquent\Builder|Realization whereActivityCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Realization whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Realization whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Realization whereRealizationOfPlanting($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Realization whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Realization whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Realization whereWorkOrderId($value)
 * @mixin \Eloquent
 */
	class IdeHelperRealization {}
}

namespace App\Models{
/**
 * App\Models\RealizationItem
 *
 * @property string $id
 * @property string $realization_id
 * @property string $plant_id
 * @property \MatanYadaev\EloquentSpatial\Objects\Geometry|null $location
 * @property string|null $image
 * @property string $planting_status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Plant $plant
 * @property-read \App\Models\Realization $realization
 * @method static \Illuminate\Database\Eloquent\Builder|RealizationItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RealizationItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RealizationItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|RealizationItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RealizationItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RealizationItem whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RealizationItem whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RealizationItem wherePlantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RealizationItem wherePlantingStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RealizationItem whereRealizationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RealizationItem whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class IdeHelperRealizationItem {}
}

namespace App\Models{
/**
 * App\Models\SharePercentage
 *
 * @property string $id
 * @property string $company_id
 * @property string $name
 * @property string $percentage
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|SharePercentage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SharePercentage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SharePercentage query()
 * @method static \Illuminate\Database\Eloquent\Builder|SharePercentage whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SharePercentage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SharePercentage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SharePercentage whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SharePercentage wherePercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SharePercentage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class IdeHelperSharePercentage {}
}

namespace App\Models{
/**
 * App\Models\Social
 *
 * @property string $id
 * @property string $sub_technical_design_id
 * @property string $activity_category
 * @property string $name_of_activity
 * @property int $quantity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Social newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Social newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Social query()
 * @method static \Illuminate\Database\Eloquent\Builder|Social whereActivityCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Social whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Social whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Social whereNameOfActivity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Social whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Social whereSubTechnicalDesignId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Social whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class IdeHelperSocial {}
}

namespace App\Models{
/**
 * App\Models\SubTechnicalDesign
 *
 * @property string $id
 * @property string $technical_design_id
 * @property string $work_area_block_id
 * @property string|null $work_area_block_plot_id
 * @property string $value_amount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $document_number
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Plant> $plants
 * @property-read int|null $plants_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Social> $socials
 * @property-read int|null $socials_count
 * @property-read \App\Models\TechnicalDesign $technical_design
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\WorkOrder> $workOrders
 * @property-read int|null $work_orders_count
 * @property-read \App\Models\WorkAreaBlock $work_area_block
 * @property-read \App\Models\WorkAreaBlockPlot|null $work_area_block_plot
 * @method static \Illuminate\Database\Eloquent\Builder|SubTechnicalDesign newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubTechnicalDesign newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubTechnicalDesign query()
 * @method static \Illuminate\Database\Eloquent\Builder|SubTechnicalDesign whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubTechnicalDesign whereDocumentNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubTechnicalDesign whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubTechnicalDesign whereTechnicalDesignId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubTechnicalDesign whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubTechnicalDesign whereValueAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubTechnicalDesign whereWorkAreaBlockId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubTechnicalDesign whereWorkAreaBlockPlotId($value)
 * @mixin \Eloquent
 */
	class IdeHelperSubTechnicalDesign {}
}

namespace App\Models{
/**
 * App\Models\TechnicalDesign
 *
 * @property string $id
 * @property string|null $company_id
 * @property string|null $das_project_id
 * @property string|null $work_area_id
 * @property string $title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\WorkAreaBlock> $blocks
 * @property-read int|null $blocks_count
 * @property-read \App\Models\Company|null $company
 * @property-read \App\Models\DasProject|null $das_project
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SubTechnicalDesign> $subTechnicalDesign
 * @property-read int|null $sub_technical_design_count
 * @property-read \App\Models\WorkArea|null $work_area
 * @method static \Illuminate\Database\Eloquent\Builder|TechnicalDesign newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TechnicalDesign newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TechnicalDesign onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|TechnicalDesign query()
 * @method static \Illuminate\Database\Eloquent\Builder|TechnicalDesign whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TechnicalDesign whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TechnicalDesign whereDasProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TechnicalDesign whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TechnicalDesign whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TechnicalDesign whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TechnicalDesign whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TechnicalDesign whereWorkAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TechnicalDesign withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|TechnicalDesign withoutTrashed()
 * @mixin \Eloquent
 */
	class IdeHelperTechnicalDesign {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property string $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class IdeHelperUser {}
}

namespace App\Models{
/**
 * App\Models\Verification
 *
 * @property string $id
 * @property string $work_order_id
 * @property string $realization_id
 * @property int $percentage
 * @property \App\Enums\VerificationStatusEnum $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Realization $realization
 * @property-read \App\Models\WorkOrder $workOrder
 * @method static \Illuminate\Database\Eloquent\Builder|Verification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Verification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Verification query()
 * @method static \Illuminate\Database\Eloquent\Builder|Verification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Verification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Verification wherePercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Verification whereRealizationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Verification whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Verification whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Verification whereWorkOrderId($value)
 * @mixin \Eloquent
 */
	class IdeHelperVerification {}
}

namespace App\Models{
/**
 * App\Models\WorkArea
 *
 * @property string $id
 * @property string|null $das_project_id
 * @property string|null $code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\WorkAreaBlock> $blocks
 * @property-read int|null $blocks_count
 * @property-read \App\Models\DasProject|null $das_project
 * @method static \Illuminate\Database\Eloquent\Builder|WorkArea newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WorkArea newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WorkArea onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|WorkArea query()
 * @method static \Illuminate\Database\Eloquent\Builder|WorkArea whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkArea whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkArea whereDasProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkArea whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkArea whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkArea whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkArea withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|WorkArea withoutTrashed()
 * @mixin \Eloquent
 */
	class IdeHelperWorkArea {}
}

namespace App\Models{
/**
 * App\Models\WorkAreaBlock
 *
 * @property string $id
 * @property string $work_area_id
 * @property string $block_name
 * @property string $block_size
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\WorkAreaBlockPlot> $plots
 * @property-read int|null $plots_count
 * @property-read \App\Models\WorkArea $work_area
 * @method static \Illuminate\Database\Eloquent\Builder|WorkAreaBlock newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WorkAreaBlock newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WorkAreaBlock query()
 * @method static \Illuminate\Database\Eloquent\Builder|WorkAreaBlock whereBlockName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkAreaBlock whereBlockSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkAreaBlock whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkAreaBlock whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkAreaBlock whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkAreaBlock whereWorkAreaId($value)
 * @mixin \Eloquent
 */
	class IdeHelperWorkAreaBlock {}
}

namespace App\Models{
/**
 * App\Models\WorkAreaBlockPlot
 *
 * @property string $id
 * @property string $work_area_block_id
 * @property string|null $planting_pattern_id
 * @property string $plot
 * @property string $plot_size
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\WorkAreaBlock $block
 * @property-read \App\Models\PlantingPattern|null $pattern
 * @method static \Illuminate\Database\Eloquent\Builder|WorkAreaBlockPlot newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WorkAreaBlockPlot newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WorkAreaBlockPlot query()
 * @method static \Illuminate\Database\Eloquent\Builder|WorkAreaBlockPlot whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkAreaBlockPlot whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkAreaBlockPlot wherePlantingPatternId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkAreaBlockPlot wherePlot($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkAreaBlockPlot wherePlotSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkAreaBlockPlot whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkAreaBlockPlot whereWorkAreaBlockId($value)
 * @mixin \Eloquent
 */
	class IdeHelperWorkAreaBlockPlot {}
}

namespace App\Models{
/**
 * App\Models\WorkOrder
 *
 * @property string $id
 * @property string $cooperative_contract_id
 * @property string $sub_technical_design_id
 * @property string $work_order_number
 * @property string $work_order_date
 * @property int $work_order_value
 * @property string|null $work_order_document
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int $passing_standard
 * @property-read \App\Models\CooperativeContract $contract
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Realization> $realizations
 * @property-read int|null $realizations_count
 * @property-read \App\Models\SubTechnicalDesign $subTechnicalDesign
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Verification> $verifications
 * @property-read int|null $verifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|WorkOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WorkOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WorkOrder onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|WorkOrder query()
 * @method static \Illuminate\Database\Eloquent\Builder|WorkOrder whereCooperativeContractId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkOrder whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkOrder wherePassingStandard($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkOrder whereSubTechnicalDesignId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkOrder whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkOrder whereWorkOrderDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkOrder whereWorkOrderDocument($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkOrder whereWorkOrderNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkOrder whereWorkOrderValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkOrder withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|WorkOrder withoutTrashed()
 * @mixin \Eloquent
 */
	class IdeHelperWorkOrder {}
}

