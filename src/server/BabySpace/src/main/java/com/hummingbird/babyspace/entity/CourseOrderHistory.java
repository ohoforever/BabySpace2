package com.hummingbird.babyspace.entity;

import java.util.Date;

/**
 * 会员报退课历史表
 */
public class CourseOrderHistory {
    /**
     * 历史id
     */
    private Integer id;

    /**
     * 订单id
     */
    private String orderId;

    /**
     * 会员id
     */
    private Integer memberId;

    /**
     * 宝宝id
     */
    private Integer childId;

    /**
     * 学校名
     */
    private String schoolName;

    /**
     * 课程名
     */
    private String courseName;

    /**
     * 报课/退课课数
     */
    private Integer courseCount;

    /**
     * 买课费用,单位分
     */
    private Integer courseAmount;

    /**
     * 添加时间
     */
    private Date insertTime;

    /**
     * 家长手机号
     */
    private String mobileNum;

    /**
     * 家长名称
     */
    private String parentName;

    /**
     * 宝宝名称
     */
    private String babyName;

    /**
     * 宝宝性别,MALE男宝宝,FEMAIL女宝宝,UNKNOWN不详
     */
    private String babySex;

    /**
     * 宝宝出生年月
     */
    private Date babyBirthday;

    /**
     * 会员课程节数
     */
    private Integer memberCourseCount;

    /**
     * ADD 新增,UPT 更新,DEL 删除,REJ 退课
     */
    private String type;

    /**
     * 经办人id
     */
    private Integer operator;

    /**
     * 某课程的总课数,它与课程有关
     */
    private Integer courseTotal;

    /**
     * @return 历史id
     */
    public Integer getId() {
        return id;
    }

    /**
     * @param id 
	 *            历史id
     */
    public void setId(Integer id) {
        this.id = id;
    }

    /**
     * @return 订单id
     */
    public String getOrderId() {
        return orderId;
    }

    /**
     * @param orderId 
	 *            订单id
     */
    public void setOrderId(String orderId) {
        this.orderId = orderId == null ? null : orderId.trim();
    }

    /**
     * @return 会员id
     */
    public Integer getMemberId() {
        return memberId;
    }

    /**
     * @param memberId 
	 *            会员id
     */
    public void setMemberId(Integer memberId) {
        this.memberId = memberId;
    }

    /**
     * @return 宝宝id
     */
    public Integer getChildId() {
        return childId;
    }

    /**
     * @param childId 
	 *            宝宝id
     */
    public void setChildId(Integer childId) {
        this.childId = childId;
    }

    /**
     * @return 学校名
     */
    public String getSchoolName() {
        return schoolName;
    }

    /**
     * @param schoolName 
	 *            学校名
     */
    public void setSchoolName(String schoolName) {
        this.schoolName = schoolName == null ? null : schoolName.trim();
    }

    /**
     * @return 课程名
     */
    public String getCourseName() {
        return courseName;
    }

    /**
     * @param courseName 
	 *            课程名
     */
    public void setCourseName(String courseName) {
        this.courseName = courseName == null ? null : courseName.trim();
    }

    /**
     * @return 报课/退课课数
     */
    public Integer getCourseCount() {
        return courseCount;
    }

    /**
     * @param courseCount 
	 *            报课/退课课数
     */
    public void setCourseCount(Integer courseCount) {
        this.courseCount = courseCount;
    }

    /**
     * @return 买课费用,单位分
     */
    public Integer getCourseAmount() {
        return courseAmount;
    }

    /**
     * @param courseAmount 
	 *            买课费用,单位分
     */
    public void setCourseAmount(Integer courseAmount) {
        this.courseAmount = courseAmount;
    }

    /**
     * @return 添加时间
     */
    public Date getInsertTime() {
        return insertTime;
    }

    /**
     * @param insertTime 
	 *            添加时间
     */
    public void setInsertTime(Date insertTime) {
        this.insertTime = insertTime;
    }

    /**
     * @return 家长手机号
     */
    public String getMobileNum() {
        return mobileNum;
    }

    /**
     * @param mobileNum 
	 *            家长手机号
     */
    public void setMobileNum(String mobileNum) {
        this.mobileNum = mobileNum;
    }

    /**
     * @return 家长名称
     */
    public String getParentName() {
        return parentName;
    }

    /**
     * @param parentName 
	 *            家长名称
     */
    public void setParentName(String parentName) {
        this.parentName = parentName == null ? null : parentName.trim();
    }

    /**
     * @return 宝宝名称
     */
    public String getBabyName() {
        return babyName;
    }

    /**
     * @param babyName 
	 *            宝宝名称
     */
    public void setBabyName(String babyName) {
        this.babyName = babyName == null ? null : babyName.trim();
    }

    /**
     * @return 宝宝性别,MALE男宝宝,FEMAIL女宝宝,UNKNOWN不详
     */
    public String getBabySex() {
        return babySex;
    }

    /**
     * @param babySex 
	 *            宝宝性别,MALE男宝宝,FEMAIL女宝宝,UNKNOWN不详
     */
    public void setBabySex(String babySex) {
        this.babySex = babySex == null ? null : babySex.trim();
    }

    /**
     * @return 宝宝出生年月
     */
    public Date getBabyBirthday() {
        return babyBirthday;
    }

    /**
     * @param babyBirthday 
	 *            宝宝出生年月
     */
    public void setBabyBirthday(Date babyBirthday) {
        this.babyBirthday = babyBirthday;
    }

    /**
     * @return 会员课程节数
     */
    public Integer getMemberCourseCount() {
        return memberCourseCount;
    }

    /**
     * @param memberCourseCount 
	 *            会员课程节数
     */
    public void setMemberCourseCount(Integer memberCourseCount) {
        this.memberCourseCount = memberCourseCount;
    }

    /**
     * @return ADD 新增,UPT 更新,DEL 删除,REJ 退课
     */
    public String getType() {
        return type;
    }

    /**
     * @param type 
	 *            ADD 新增,UPT 更新,DEL 删除,REJ 退课
     */
    public void setType(String type) {
        this.type = type == null ? null : type.trim();
    }

    /**
     * @return 经办人id
     */
    public Integer getOperator() {
        return operator;
    }

    /**
     * @param operator 
	 *            经办人id
     */
    public void setOperator(Integer operator) {
        this.operator = operator;
    }

    /**
     * @return 某课程的总课数,它与课程有关
     */
    public Integer getCourseTotal() {
        return courseTotal;
    }

    /**
     * @param courseTotal 
	 *            某课程的总课数,它与课程有关
     */
    public void setCourseTotal(Integer courseTotal) {
        this.courseTotal = courseTotal;
    }
}